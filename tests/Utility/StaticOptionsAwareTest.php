<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Utility;

use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticOptionsAwareTest extends TestCase
{
    /**
     * @var StaticOptionsAwareTrait
     */
    private $staticOptionsAware;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->staticOptionsAware = new StaticOptionsAwareMock();
    }

    public function testDefaultState()
    {
        $this->assertEmpty($this->staticOptionsAware->getStaticOptions());
    }

    public function testSetStaticOptions()
    {
        $this->staticOptionsAware->setStaticOptions($options = [$option = 'foo' => $value = 'bar']);
        $this->staticOptionsAware->setStaticOptions($options);

        $this->assertTrue($this->staticOptionsAware->hasStaticOptions());
        $this->assertSame($options, $this->staticOptionsAware->getStaticOptions());
        $this->assertTrue($this->staticOptionsAware->hasStaticOption($option));
        $this->assertSame($value, $this->staticOptionsAware->getStaticOption($option));
    }

    public function testAddStaticOptions()
    {
        $this->staticOptionsAware->setStaticOptions($firstOptions = ['foo' => 'bar']);
        $this->staticOptionsAware->addStaticOptions($secondOptions = ['baz' => 'bat']);

        $this->assertTrue($this->staticOptionsAware->hasStaticOptions());
        $this->assertSame(
            array_merge($firstOptions, $secondOptions),
            $this->staticOptionsAware->getStaticOptions()
        );
    }

    public function testSetStaticOption()
    {
        $this->staticOptionsAware->setStaticOption($option = 'foo', $value = 'bar');

        $this->assertTrue($this->staticOptionsAware->hasStaticOptions());
        $this->assertSame([$option => $value], $this->staticOptionsAware->getStaticOptions());
        $this->assertTrue($this->staticOptionsAware->hasStaticOption($option));
        $this->assertSame($value, $this->staticOptionsAware->getStaticOption($option));
    }

    public function testRemoveStaticOption()
    {
        $this->staticOptionsAware->setStaticOption($option = 'foo', 'bar');
        $this->staticOptionsAware->removeStaticOption($option);

        $this->assertFalse($this->staticOptionsAware->hasStaticOptions());
        $this->assertFalse($this->staticOptionsAware->hasStaticOption($option));
    }

    public function testMissingStaticOption()
    {
        $this->assertNull($this->staticOptionsAware->getStaticOption('foo'));
    }
}

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticOptionsAwareMock implements StaticOptionsAwareInterface
{
    use StaticOptionsAwareTrait;
}
