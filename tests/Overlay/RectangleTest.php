<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\Rectangle;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Rectangle
     */
    private $rectangle;

    /**
     * @var Bound
     */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangle = new Rectangle($this->bound = $this->createBoundMock());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->rectangle);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->rectangle);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->rectangle);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('rectangle', $this->rectangle->getVariable());
        $this->assertSame($this->bound, $this->rectangle->getBound());
        $this->assertFalse($this->rectangle->hasOptions());
    }

    public function testInitialState()
    {
        $this->rectangle = new Rectangle($this->bound, $options = ['foo' => 'bar']);

        $this->assertStringStartsWith('rectangle', $this->rectangle->getVariable());
        $this->assertSame($this->bound, $this->rectangle->getBound());
        $this->assertSame($options, $this->rectangle->getOptions());
    }

    public function testBound()
    {
        $this->rectangle->setBound($bound = $this->createBoundMock());

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
