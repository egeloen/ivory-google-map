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
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Polygon
     */
    private $polygon;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygon = new Polygon();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableInterface::class, $this->polygon);
        $this->assertInstanceOf(OptionsAwareInterface::class, $this->polygon);
        $this->assertInstanceOf(VariableAwareInterface::class, $this->polygon);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('polygon', $this->polygon->getVariable());
        $this->assertFalse($this->polygon->hasCoordinates());
        $this->assertEmpty($this->polygon->getCoordinates());
        $this->assertFalse($this->polygon->hasOptions());
    }

    public function testInitialState()
    {
        $this->polygon = new Polygon(
            $coordinates = [$coordinate = $this->createCoordinateMock()],
            $options = ['foo' => 'bar']
        );

        $this->assertStringStartsWith('polygon', $this->polygon->getVariable());
        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertTrue($this->polygon->hasCoordinate($coordinate));
        $this->assertSame($coordinates, $this->polygon->getCoordinates());
        $this->assertSame($options, $this->polygon->getOptions());
    }

    public function testSetCoordinates()
    {
        $this->polygon->setCoordinates($coordinates = [$coordinate = $this->createCoordinateMock()]);
        $this->polygon->setCoordinates($coordinates);

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertTrue($this->polygon->hasCoordinate($coordinate));
        $this->assertSame($coordinates, $this->polygon->getCoordinates());
    }

    public function testAddCoordinates()
    {
        $this->polygon->setCoordinates($firstCoordinates = [$this->createCoordinateMock()]);
        $this->polygon->addCoordinates($secondCoordinates = [$this->createCoordinateMock()]);

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertSame(array_merge($firstCoordinates, $secondCoordinates), $this->polygon->getCoordinates());
    }

    public function testAddCoordinate()
    {
        $this->polygon->addCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertTrue($this->polygon->hasCoordinate($coordinate));
        $this->assertSame([$coordinate], $this->polygon->getCoordinates());
    }

    public function testRemoveCoordinate()
    {
        $this->polygon->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polygon->removeCoordinate($coordinate);

        $this->assertFalse($this->polygon->hasCoordinates());
        $this->assertFalse($this->polygon->hasCoordinate($coordinate));
        $this->assertEmpty($this->polygon->getCoordinates());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
