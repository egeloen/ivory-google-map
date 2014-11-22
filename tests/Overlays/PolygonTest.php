<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends AbstractExtendableTest
{
    /** @var \Ivory\GoogleMap\Overlays\Polygon */
    private $polygon;

    /** @var array */
    private $coordinates;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygon = new Polygon($this->coordinates = array($this->createCoordinateMock()));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinates);
        unset($this->polygon);
    }

    public function testInheritance()
    {
        $this->assertOptionsAssetInstance($this->polygon);
        $this->assertExtendableInstance($this->polygon);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('polygon_', $this->polygon->getVariable());
        $this->assertCoordinates($this->coordinates);
        $this->assertFalse($this->polygon->hasOptions());
    }

    public function testSetCoordinates()
    {
        $this->polygon->setCoordinates($coordinates = array($this->createCoordinateMock()));

        $this->assertCoordinates($coordinates);
    }

    public function testAddCoordinates()
    {
        $this->polygon->setCoordinates($coordinates = array($this->createCoordinateMock()));
        $this->polygon->addCoordinates($newCoordinate = array($this->createCoordinateMock()));

        $this->assertCoordinates(array_merge($coordinates, $newCoordinate));
    }

    public function testRemoveCoordinates()
    {
        $this->polygon->setCoordinates($coordinates = array($this->createCoordinateMock()));
        $this->polygon->removeCoordinates($coordinates);

        $this->assertNoCoordinates();
    }

    public function testResetCoordinates()
    {
        $this->polygon->setCoordinates(array($this->createCoordinateMock()));
        $this->polygon->resetCoordinates();

        $this->assertNoCoordinates();
    }

    public function testAddCoordinate()
    {
        $this->polygon->addCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertCoordinate($coordinate);
    }

    public function testAddCoordinateUnicity()
    {
        $this->polygon->resetCoordinates();
        $this->polygon->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polygon->addCoordinate($coordinate);

        $this->assertCoordinates(array($coordinate));
    }

    public function testRemoveCoordinate()
    {
        $this->polygon->addCoordinate($coordinate = $this->createCoordinateMock());
        $this->polygon->removeCoordinate($coordinate);

        $this->assertNoCoordinate($coordinate);
    }

    public function testRenderExtend()
    {
        $this->polygon->setVariable('polygon');

        $this->assertSame(
            'polygon.getPath().forEach(function(e){bound.extend(e);})',
            $this->polygon->renderExtend($this->createBoundMock())
        );
    }

    /**
     * Asserts there are coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    private function assertCoordinates($coordinates)
    {
        $this->assertInternalType('array', $coordinates);

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertSame($coordinates, $this->polygon->getCoordinates());

        foreach ($coordinates as $coordinate) {
            $this->assertCoordinate($coordinate);
        }
    }

    /**
     * Asserts there is a coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    private function assertCoordinate($coordinate)
    {
        $this->assertCoordinateInstance($coordinate);
        $this->assertTrue($this->polygon->hasCoordinate($coordinate));
    }

    /**
     * Asserts there are no coordinates.
     */
    private function assertNoCoordinates()
    {
        $this->assertFalse($this->polygon->hasCoordinates());
        $this->assertEmpty($this->polygon->getCoordinates());
    }

    /**
     * Asserts there is no coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    private function assertNoCoordinate($coordinate)
    {
        $this->assertCoordinateInstance($coordinate);
        $this->assertFalse($this->polygon->hasCoordinate($coordinate));
    }
}
