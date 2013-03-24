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

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\InfoWindow;

/**
 * Info window test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\InfoWindow */
    protected $infoWindow;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindow = new InfoWindow();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoWindow);
    }

    public function testDefaultState()
    {
        $this->assertSame('<p>Default content</p>', $this->infoWindow->getContent());
        $this->assertNull($this->infoWindow->getPosition());
        $this->assertFalse($this->infoWindow->hasPixelOffset());
        $this->assertFalse($this->infoWindow->isOpen());
        $this->assertTrue($this->infoWindow->isAutoOpen());
        $this->assertSame(MouseEvent::CLICK, $this->infoWindow->getOpenEvent());
        $this->assertFalse($this->infoWindow->isAutoClose());
    }

    public function testInitialState()
    {
        $content = 'foo';
        $position = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $pixelOffset = $this->getMock('Ivory\GoogleMap\Base\Size');
        $opentEvent = MouseEvent::DBLCLICK;

        $this->infoWindow = new InfoWindow($content, $position, $pixelOffset, true, $opentEvent, false, true);

        $this->assertSame($content, $this->infoWindow->getContent());
        $this->assertSame($position, $this->infoWindow->getPosition());
        $this->assertSame($pixelOffset, $this->infoWindow->getPixelOffset());
        $this->assertTrue($this->infoWindow->isOpen());
        $this->assertFalse($this->infoWindow->isAutoOpen());
        $this->assertSame($opentEvent, $this->infoWindow->getOpenEvent());
        $this->assertTrue($this->infoWindow->isAutoClose());
    }

    public function testPositionWithCoordinate()
    {
        $position = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->infoWindow->setPosition($position);

        $this->assertSame($position, $this->infoWindow->getPosition());
    }

    public function testPositionWithLatitudeAndLongitude()
    {
        $latitude = 2;
        $longitude = 3;

        $this->infoWindow->setPosition($latitude, $longitude, true);

        $this->assertSame($latitude, $this->infoWindow->getPosition()->getLatitude());
        $this->assertSame($longitude, $this->infoWindow->getPosition()->getLongitude());
        $this->assertTrue($this->infoWindow->getPosition()->isNoWrap());
    }

    public function testPositionWithNullValue()
    {
        $this->infoWindow->setPosition($this->getMock('Ivory\GoogleMap\Base\Coordinate'));
        $this->infoWindow->setPosition(null);

        $this->assertNull($this->infoWindow->getPosition());
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
        $this->infoWindow->setPosition('foo');
    }

    public function testPixedOffsetWithSize()
    {
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');
        $this->infoWindow->setPixelOffset($size);

        $this->assertSame($size, $this->infoWindow->getPixelOffset());
    }

    public function testPixedOffsetWithWidthAndHeight()
    {
        $width = 2;
        $widthUnit = 'px';
        $height = 3;
        $heightUnit = '%';

        $this->infoWindow->setPixelOffset($width, $height, $widthUnit, $heightUnit);

        $this->assertSame($width, $this->infoWindow->getPixelOffset()->getWidth());
        $this->assertSame($widthUnit, $this->infoWindow->getPixelOffset()->getWidthUnit());
        $this->assertSame($height, $this->infoWindow->getPixelOffset()->getHeight());
        $this->assertSame($heightUnit, $this->infoWindow->getPixelOffset()->getHeightUnit());
    }

    public function testPixelOffsetWithNullValue()
    {
        $this->infoWindow->setPixelOffset($this->getMock('Ivory\GoogleMap\Base\Size'));
        $this->infoWindow->setPixelOffset(null);

        $this->assertNull($this->infoWindow->getPixelOffset());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The pixel offset setter arguments is invalid.
     * The available prototypes are :
     * - function setPixelOffset(Ivory\GoogleMap\Base\Size $scaledSize)
     * - function setPixelOffset(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     */
    public function testPixedOffsetWithInvalidValue()
    {
        $this->infoWindow->setPixelOffset('foo');
    }

    public function testContentWithValidValue()
    {
        $this->infoWindow->setContent('foo');

        $this->assertSame('foo', $this->infoWindow->getContent());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The content of an info window must be a string value.
     */
    public function testContentWithInvalidValue()
    {
        $this->infoWindow->setContent(true);
    }

    public function testOpenWithValidValue()
    {
        $this->infoWindow->setOpen(true);

        $this->assertTrue($this->infoWindow->isOpen());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The open property of an info window must be a boolean value.
     */
    public function testOpenWithInvalidValue()
    {
        $this->infoWindow->setOpen('foo');
    }

    public function testAutoOpenWithValidValue()
    {
        $this->infoWindow->setAutoOpen(true);

        $this->assertTrue($this->infoWindow->isAutoOpen());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The auto open property of an info window must be a boolean value.
     */
    public function testAutoOpenWithInvalidValue()
    {
        $this->infoWindow->setAutoOpen('foo');
    }

    public function testOpenEventWithValidValue()
    {
        $this->infoWindow->setOpenEvent(MouseEvent::MOUSEDOWN);

        $this->assertSame(MouseEvent::MOUSEDOWN, $this->infoWindow->getOpenEvent());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The only available open event are : click, dblclick, mouseup, mousedown, mouseover,
     * mouseout.
     */
    public function testOpenEventWithInvalidValue()
    {
        $this->infoWindow->setOpenEvent('foo');
    }

    public function testAutoCloseWithValidValue()
    {
        $this->infoWindow->setAutoClose(true);

        $this->assertTrue($this->infoWindow->isAutoClose());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The info window auto close flag must be a boolean value.
     */
    public function testAutoCloseWithInvalidValue()
    {
        $this->infoWindow->setAutoClose('foo');
    }
}
