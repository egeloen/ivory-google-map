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

use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\GoogleMap\Overlays\MarkerShapeType;

/**
 * Marker shape test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerShape */
    private $markerShape;

    /** @var string */
    private $type;

    /** @var array */
    private $coordinates;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShape = new MarkerShape(
            $this->type = MarkerShapeType::CIRCLE,
            $this->coordinates = array(0, 0, 1)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerShape);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->markerShape);
    }

    public function testInitialState()
    {
        $this->assertStringStartsWith('marker_shape_', $this->markerShape->getVariable());
        $this->assertSame($this->type, $this->markerShape->getType());
        $this->assertCoordinates($this->coordinates);
    }

    public function testSetType()
    {
        $this->markerShape->setType($type = MarkerShapeType::RECTANGLE);

        $this->assertSame($type, $this->markerShape->getType());
    }

    public function testResetCoordinates()
    {
        $this->markerShape->resetCoordinates();

        $this->assertNoCoordinates();
    }

    public function testSetCoordinates()
    {
        $this->markerShape->setCoordinates($coordinates = array(1, 2, 3, 4));

        $this->assertCoordinates($coordinates);
    }

    public function testSetCircleCoordinates()
    {
        $this->markerShape->setCircleCoordinates($x = 1, $y = 2, $radius = 3);

        $this->assertCoordinates(array($x, $y, $radius));
    }

    public function testSetRectangleCoordinates()
    {
        $this->markerShape->setRectangleCoordinates($x1 = 1, $y1 = 2, $x2 = 3, $y2 = 4);

        $this->assertCoordinates(array($x1, $y1, $x2, $y2));
    }

    public function testSetPolygonCoordinates()
    {
        $this->markerShape->setPolygonCoordinates($polygonCoordinates = array(1, 2, 3, 4));

        $this->assertCoordinates($polygonCoordinates);
    }

    public function testAddPolygonCoordinate()
    {
        $this->markerShape->resetCoordinates();
        $this->markerShape->addPolygonCoordinate($x1 = 1, $y1 = 2);
        $this->markerShape->addPolygonCoordinate($x2 = 3, $y2 = 4);

        $this->assertCoordinates(array($x1, $y1, $x2, $y2));
    }

    /**
     * Asserts there are coordinates.
     *
     * @param array $coordinates The coordinates.
     */
    private function assertCoordinates($coordinates)
    {
        $this->assertInternalType('array', $coordinates);

        $this->assertTrue($this->markerShape->hasCoordinates());
        $this->assertSame($coordinates, $this->markerShape->getCoordinates());
    }

    /**
     * Asserts there are no coordinates.
     */
    private function assertNoCoordinates()
    {
        $this->assertFalse($this->markerShape->hasCoordinates());
        $this->assertEmpty($this->markerShape->getCoordinates());
    }
}
