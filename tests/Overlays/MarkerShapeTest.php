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

/**
 * Marker shape test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerShape */
    protected $markerShape;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShape = new MarkerShape();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerShape);
    }

    public function testDefaultState()
    {
        $this->assertSame('poly', $this->markerShape->getType());
        $this->assertTrue($this->markerShape->hasCoordinates());
        $this->assertSame(array(1, 1, 1, -1, -1, -1, -1, 1), $this->markerShape->getCoordinates());
    }

    public function testInitialState()
    {
        $type = 'rect';
        $coordinates = array(1, 1, -1, -1);

        $this->markerShape = new MarkerShape($type, $coordinates);

        $this->assertSame($type, $this->markerShape->getType());
        $this->assertSame($coordinates, $this->markerShape->getCoordinates());
    }

    public function testTypeWithValidValue()
    {
        $this->markerShape->setType('rect');

        $this->assertSame('rect', $this->markerShape->getType());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The type of a marker shape can only be : circle, poly, rect.
     */
    public function testTypeWithInvalidValue()
    {
        $this->markerShape->setType('foo');
    }

    public function testCircleCoordinatesWithValidValue()
    {
        $this->markerShape->setType('circle');
        $this->markerShape->setCoordinates(array(1, 2, 3));

        $this->assertSame(array(1, 2, 3), $this->markerShape->getCoordinates());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The coordinates setter arguments is invalid if the marker shape type is circle.
     * The available prototype is : function setCoordinates(array(double $x, double $y, double $r))
     */
    public function testCircleCoordinatesWithInvalidValue()
    {
        $this->markerShape->setType('circle');
        $this->markerShape->setCoordinates(array(true));
    }

    public function testPolyCoordinatesWithValidValue()
    {
        $this->markerShape->setType('poly');
        $this->markerShape->setCoordinates(array(1, 2, 3, 4, 5, 6));

        $this->assertSame(array(1, 2, 3, 4, 5, 6), $this->markerShape->getCoordinates());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The coordinates setter arguments is invalid if the marker shape type is poly.
     * The available prototype is : function setCoordinates(array(double $x1, double $y1, ..., double $xn, double $yn))
     */
    public function testPolyCoordinatesWithInvalidParametersCount()
    {
        $this->markerShape->setType('poly');
        $this->markerShape->setCoordinates(array(1));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The coordinates setter arguments is invalid if the marker shape type is poly.
     * The available prototype is : function setCoordinates(array(double $x1, double $y1, ..., double $xn, double $yn))
     */
    public function testPolyCoordinatesWithInvalidValue()
    {
        $this->markerShape->setType('poly');
        $this->markerShape->setCoordinates(array(1, true));
    }

    public function testRectCoordinatesWithValidValue()
    {
        $this->markerShape->setType('rect');
        $this->markerShape->setCoordinates(array(1, 2, 3, 4));

        $this->assertSame(array(1, 2, 3, 4), $this->markerShape->getCoordinates());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The coordinates setter arguments is invalid if the marker shape type is rect.
     * The available prototype is : function setCoordinates(array(double $x1, double $y1, double $x2, double $y2))
     */
    public function testRectCoordinatesWithInvalidValue()
    {
        $this->markerShape->setType('rect');
        $this->markerShape->setCoordinates(array(true));
    }

    public function testAddPolyCoordinateWithValidValue()
    {
        $this->markerShape->resetCoordinates();
        $this->markerShape->setType('poly');

        $this->markerShape->addPolyCoordinate(1, 2);
        $this->markerShape->addPolyCoordinate(3, 4);

        $this->assertSame(array(1, 2, 3, 4), $this->markerShape->getCoordinates());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The MarkerShape::addPolyCoordinate($x, $y) method can only be use with a marker
     * shape which has type poly.
     */
    public function testAddPolyCoordinateWithInvalidType()
    {
        $this->markerShape->setType('rect');
        $this->markerShape->addPolyCoordinate(1, 2);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The x & y coordinates of a poly marker shape must be numeric values.
     */
    public function testAddPolyCoordinateWithInvalidValue()
    {
        $this->markerShape->setType('poly');
        $this->markerShape->addPolyCoordinate(true, false);
    }
}
