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
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Polyline
     */
    private $polyline;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polyline = new Polyline();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->polyline);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->polyline);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->polyline);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('polyline', $this->polyline->getVariable());
        $this->assertFalse($this->polyline->hasCoordinates());
        $this->assertFalse($this->polyline->hasOptions());
    }

    public function testInitialState()
    {
        $this->polyline = new Polyline(
            $coordinates = [$coordinate = $this->createCoordinateMock()],
            $options = ['foo' => 'bar']
        );

        $this->assertStringStartsWith('polyline', $this->polyline->getVariable());
        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertTrue($this->polyline->hasCoordinate($coordinate));
        $this->assertSame($coordinates, $this->polyline->getCoordinates());
        $this->assertSame($options, $this->polyline->getOptions());
    }

    public function testSetCoordinates()
    {
        $this->polyline->setCoordinates($coordinates = [$coordinate = $this->createCoordinateMock()]);
        $this->polyline->setCoordinates($coordinates);

        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertTrue($this->polyline->hasCoordinate($coordinate));
        $this->assertSame($coordinates, $this->polyline->getCoordinates());
    }

    public function testAddCoordinates()
    {
        $this->polyline->setCoordinates($firstCoordinates = [$this->createCoordinateMock()]);
        $this->polyline->addCoordinates($secondCoordinates = [$this->createCoordinateMock()]);

        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertSame(array_merge($firstCoordinates, $secondCoordinates), $this->polyline->getCoordinates());
    }

    public function testAddCoordinate()
    {
        $this->polyline->addCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertTrue($this->polyline->hasCoordinate($coordinate));
        $this->assertSame([$coordinate], $this->polyline->getCoordinates());
    }

    public function testRemoveCoordinate()
    {
        $this->polyline->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polyline->removeCoordinate($coordinate);

        $this->assertFalse($this->polyline->hasCoordinates());
        $this->assertFalse($this->polyline->hasCoordinate($coordinate));
        $this->assertEmpty($this->polyline->getCoordinates());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
