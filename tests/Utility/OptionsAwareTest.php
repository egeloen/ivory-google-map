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

use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionsAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OptionsAwareTrait
     */
    private $optionsAware;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->optionsAware = new OptionsAwareMock();
    }

    public function testDefaultState()
    {
        $this->assertEmpty($this->optionsAware->getOptions());
    }

    public function testSetOptions()
    {
        $this->optionsAware->setOptions($options = [$option = 'foo' => $value = 'bar']);
        $this->optionsAware->setOptions($options);

        $this->assertTrue($this->optionsAware->hasOptions());
        $this->assertSame($options, $this->optionsAware->getOptions());
        $this->assertTrue($this->optionsAware->hasOption($option));
        $this->assertSame($value, $this->optionsAware->getOption($option));
    }

    public function testAddOptions()
    {
        $this->optionsAware->setOptions($firstOptions = ['foo' => 'bar']);
        $this->optionsAware->addOptions($secondOptions = ['baz' => 'bat']);

        $this->assertTrue($this->optionsAware->hasOptions());
        $this->assertSame(array_merge($firstOptions, $secondOptions), $this->optionsAware->getOptions());
    }

    public function testSetOption()
    {
        $this->optionsAware->setOption($option = 'foo', $value = 'bar');

        $this->assertTrue($this->optionsAware->hasOptions());
        $this->assertSame([$option => $value], $this->optionsAware->getOptions());
        $this->assertTrue($this->optionsAware->hasOption($option));
        $this->assertSame($value, $this->optionsAware->getOption($option));
    }

    public function testRemoveOption()
    {
        $this->optionsAware->setOption($option = 'foo', 'bar');
        $this->optionsAware->removeOption($option);

        $this->assertFalse($this->optionsAware->hasOptions());
        $this->assertFalse($this->optionsAware->hasOption($option));
    }

    public function testMissingOption()
    {
        $this->assertNull($this->optionsAware->getOption('foo'));
    }
}

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionsAwareMock implements OptionsAwareInterface
{
    use OptionsAwareTrait;
}
