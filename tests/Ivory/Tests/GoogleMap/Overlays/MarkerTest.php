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

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Marker */
    protected $marker;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->marker = new Marker();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->marker);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $this->marker->getPosition());
        $this->assertFalse($this->marker->hasAnimation());
        $this->assertFalse($this->marker->hasIcon());
        $this->assertFalse($this->marker->hasShadow());
        $this->assertFalse($this->marker->hasShape());
        $this->assertFalse($this->marker->hasInfoWindow());
    }

    public function testInitialState()
    {
        $position = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $animation = Animation::DROP;

        $icon = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $icon
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $shadow = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $shadow
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $shape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $shape
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');

        $this->marker = new Marker($position, $animation, $icon, $shadow, $shape, $infoWindow);

        $this->assertSame($position, $this->marker->getPosition());
        $this->assertSame($animation, $this->marker->getAnimation());
        $this->assertSame($icon, $this->marker->getIcon());
        $this->assertSame($shadow, $this->marker->getShadow());
        $this->assertSame($shape, $this->marker->getShape());
        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }

    public function testPositionWithCoordinate()
    {
        $coordinate = $this->getMock('ivory\GoogleMap\Base\Coordinate');
        $this->marker->setPosition($coordinate);

        $this->assertSame($coordinate, $this->marker->getPosition());
    }

    public function testPositionWithLatitudeAndLongitude()
    {
        $latitude = 1;
        $longitude = 2;

        $this->marker->setPosition($latitude, $longitude, true);

        $this->assertSame($latitude, $this->marker->getPosition()->getLatitude());
        $this->assertSame($longitude, $this->marker->getPosition()->getLongitude());
        $this->assertTrue($this->marker->getPosition()->isNoWrap());
    }

    public function testPositionWithNullValue()
    {
        $this->marker->setPosition($this->getMock('ivory\GoogleMap\Base\Coordinate'));
        $this->marker->setPosition(null);

        $this->assertNull($this->marker->getPosition());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The position setter arguments is invalid.
     * The available prototypes are :
     * - function setPosition(Ivory\GoogleMap\Base\Coordinate $position)
     * - function setPosition(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testPositionWithInvalidValue()
    {
        $this->marker->setPosition('foo');
    }

    public function testAnimationWithValidValue()
    {
        $this->marker->setAnimation(Animation::DROP);

        $this->assertSame(Animation::DROP, $this->marker->getAnimation());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The animation of a marker can only be : bounce, drop.
     */
    public function testAnimationWithInvalidValue()
    {
        $this->marker->setAnimation('foo');
    }

    public function testIconWithValidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $this->marker->setIcon($markerImage);

        $this->assertSame($markerImage, $this->marker->getIcon());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker image icon must have an url.
     */
    public function testIconWithInvalidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $this->marker->setIcon($markerImage);
    }

    public function testIconWithUrl()
    {
        $this->marker->setIcon('foo');

        $this->assertSame('foo', $this->marker->getIcon()->getUrl());
    }

    public function testIconWithNullValue()
    {
        $this->marker->setIcon('foo');
        $this->marker->setIcon(null);

        $this->assertNull($this->marker->getIcon());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The icon setter arguments is invalid.
     * The available prototypes are :
     * - function setIcon(Ivory\GoogleMap\Overlays\MarkerImage $markerImage = null)
     * - function setIcon(string $url = null)
     */
    public function testIconWithInvalidValue()
    {
        $this->marker->setIcon(true);
    }

    public function testShadowWithValidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $this->marker->setShadow($markerImage);

        $this->assertSame($markerImage, $this->marker->getShadow());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker image shadow must have an url.
     */
    public function testShadowWithInvalidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $this->marker->setShadow($markerImage);
    }

    public function testShadowWithUrl()
    {
        $this->marker->setShadow('foo');

        $this->assertSame('foo', $this->marker->getShadow()->getUrl());
    }

    public function testShadowWithNullValue()
    {
        $this->marker->setShadow('foo');
        $this->marker->setShadow(null);

        $this->assertNull($this->marker->getShadow());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The shadow setter arguments is invalid.
     * The available prototypes are :
     * - function setShadow(Ivory\GoogleMap\Overlays\MarkerImage $markerImage = null)
     * - function setShadow(string $url = null)
     */
    public function testShadowWithInvalidValue()
    {
        $this->marker->setShadow(true);
    }

    public function testShapeWithValidMarkerShape()
    {
        $markerShape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $markerShape
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->marker->setShape($markerShape);

        $this->assertSame($markerShape, $this->marker->getShape());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker shape must have coordinates.
     */
    public function testShapeWithInvalidMarkerShape()
    {
        $markerShape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $this->marker->setShape($markerShape);
    }

    public function testShapeWithTypeAndCoordinates()
    {
        $type = 'poly';
        $coordinates = array(1, 2, 3, 4);

        $this->marker->setShape($type, $coordinates);

        $this->assertSame($type, $this->marker->getShape()->getType());
        $this->assertSame($coordinates, $this->marker->getShape()->getCoordinates());
    }

    public function testShapeWithNullValue()
    {
        $this->marker->setShape('poly', array(1, 2, 3, 4));
        $this->marker->setShape(null);

        $this->assertNull($this->marker->getShape());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The shape setter arguments is invalid.
     * The available prototypes are :
     * - function setShape(Ivory\GoogleMap\Overlays\MarkerShape $shape = null)
     * - function setShape(string $type, array $coordinates)
     */
    public function testShapeWithInvalidValue()
    {
        $this->marker->setShape(true);
    }

    public function testInfoWindow()
    {
        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');
        $this->marker->setInfoWindow($infoWindow);

        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }
}
