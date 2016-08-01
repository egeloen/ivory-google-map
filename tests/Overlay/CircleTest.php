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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ivory\GoogleMap\Overlay\Circle
     */
    private $circle;

    /**
     * @var Coordinate|\PHPUnit_Framework_MockObject_MockObject
     */
    private $center;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circle = new Circle($this->center = $this->createCoordinateMock());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->circle);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->circle);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->circle);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('circle', $this->circle->getVariable());
        $this->assertSame($this->center, $this->circle->getCenter());
        $this->assertSame(1.0, $this->circle->getRadius());
        $this->assertFalse($this->circle->hasOptions());
    }

    public function testInitialState()
    {
        $this->circle = new Circle($this->center, $radius = 2.1, $options = ['foo' => 'bar']);

        $this->assertStringStartsWith('circle', $this->circle->getVariable());
        $this->assertSame($this->center, $this->circle->getCenter());
        $this->assertSame($radius, $this->circle->getRadius());
        $this->assertSame($options, $this->circle->getOptions());
    }

    public function testCenter()
    {
        $this->circle->setCenter($center = $this->createCoordinateMock());

        $this->assertSame($center, $this->circle->getCenter());
    }

    public function testRadius()
    {
        $this->circle->setRadius($radius = 2.1);

        $this->assertSame($radius, $this->circle->getRadius());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
