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

use Ivory\GoogleMap\Overlays\MarkerImage;

/**
 * Marker image test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $markerImage;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerImage = new MarkerImage();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerImage);
    }

    public function testDefaultState()
    {
        $this->assertSame('//maps.gstatic.com/mapfiles/markers/marker.png', $this->markerImage->getUrl());
        $this->assertFalse($this->markerImage->hasAnchor());
        $this->assertFalse($this->markerImage->hasOrigin());
        $this->assertFalse($this->markerImage->hasScaledSize());
        $this->assertFalse($this->markerImage->hasSize());
    }

    public function testInitialState()
    {
        $url = 'foo';
        $anchor = $this->getMock('Ivory\GoogleMap\Base\Point');
        $origin = $this->getMock('Ivory\GoogleMap\Base\Point');
        $scaledSize = $this->getMock('Ivory\GoogleMap\Base\Size');
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');

        $this->markerImage = new MarkerImage($url, $anchor, $origin, $scaledSize, $size);

        $this->assertSame($url, $this->markerImage->getUrl());
        $this->assertSame($anchor, $this->markerImage->getAnchor());
        $this->assertSame($origin, $this->markerImage->getOrigin());
        $this->assertSame($scaledSize, $this->markerImage->getScaledSize());
        $this->assertSame($size, $this->markerImage->getSize());
    }

    public function testUrlWithValidValue()
    {
        $this->markerImage->setUrl('foo');

        $this->assertSame('foo', $this->markerImage->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The url of a maker image must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->markerImage->setUrl(true);
    }

    public function testAnchorWithPoint()
    {
        $point = $this->getMock('Ivory\GoogleMap\Base\Point');
        $this->markerImage->setAnchor($point);

        $this->assertSame($point, $this->markerImage->getAnchor());
    }

    public function testAnchorWithXAndY()
    {
        $x = 2;
        $y = 3;

        $this->markerImage->setAnchor($x, $y);

        $this->assertSame($x, $this->markerImage->getAnchor()->getX());
        $this->assertSame($y, $this->markerImage->getAnchor()->getY());
    }

    public function testAnchorWithNullValue()
    {
        $this->markerImage->setAnchor($this->getMock('Ivory\GoogleMap\Base\Point'));
        $this->markerImage->setAnchor(null);

        $this->assertNull($this->markerImage->getAnchor());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The anchor setter arguments is invalid.
     * The available prototypes are :
     * - function setAnchor(Ivory\GoogleMap\Base\Point $anchor)
     * - function setAnchor(double x, double y)
     */
    public function testAnchorWithInvalidValue()
    {
        $this->markerImage->setAnchor(true);
    }

    public function testOriginWithPoint()
    {
        $point = $this->getMock('Ivory\GoogleMap\Base\Point');
        $this->markerImage->setOrigin($point);

        $this->assertSame($point, $this->markerImage->getOrigin());
    }

    public function testOriginWithXAndY()
    {
        $x = 2;
        $y = 3;

        $this->markerImage->setOrigin($x, $y);

        $this->assertSame($x, $this->markerImage->getOrigin()->getX());
        $this->assertSame($y, $this->markerImage->getOrigin()->getY());
    }

    public function testOriginWithNullValue()
    {
        $this->markerImage->setOrigin($this->getMock('Ivory\GoogleMap\Base\Point'));
        $this->markerImage->setOrigin(null);

        $this->assertNull($this->markerImage->getOrigin());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The origin setter arguments is invalid.
     * The available prototypes are :
     * - function setOrigin(Ivory\GoogleMap\Base\Point $anchor)
     * - function setOrigin(double x, double y)
     */
    public function testOriginWithInvalidValue()
    {
        $this->markerImage->setOrigin(true);
    }

    public function testScaledSizeWithSize()
    {
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');
        $this->markerImage->setScaledSize($size);

        $this->assertSame($size, $this->markerImage->getScaledSize());
    }

    public function testScaledSizeWithWidthAndHeight()
    {
        $width = 2;
        $widthUnit = 'px';

        $height = 3;
        $heightUnit = '%';

        $this->markerImage->setScaledSize($width, $height, $widthUnit, $heightUnit);

        $this->assertSame($width, $this->markerImage->getScaledSize()->getWidth());
        $this->assertSame($height, $this->markerImage->getScaledSize()->getHeight());
        $this->assertSame($widthUnit, $this->markerImage->getScaledSize()->getWidthUnit());
        $this->assertSame($heightUnit, $this->markerImage->getScaledSize()->getHeightUnit());
    }

    public function testScaledSizeWithNullValue()
    {
        $this->markerImage->setScaledSize($this->getMock('Ivory\GoogleMap\Base\Size'));
        $this->markerImage->setScaledSize(null);

        $this->assertNull($this->markerImage->getScaledSize());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The scaled size setter arguments is invalid.
     * The available prototypes are :
     * - function setScaledSize(Ivory\GoogleMap\Base\Size $scaledSize = null)
     * - function setScaledSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     */
    public function testScaledSizeWithInvalidValue()
    {
        $this->markerImage->setScaledSize('foo');
    }

    public function testSizeWithSize()
    {
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');
        $this->markerImage->setSize($size);

        $this->assertSame($size, $this->markerImage->getSize());
    }

    public function testSizeWithWidthAndHeight()
    {
        $width = 2;
        $widthUnit = 'px';

        $height = 3;
        $heightUnit = '%';

        $this->markerImage->setSize($width, $height, $widthUnit, $heightUnit);

        $this->assertSame($width, $this->markerImage->getSize()->getWidth());
        $this->assertSame($height, $this->markerImage->getSize()->getHeight());
        $this->assertSame($widthUnit, $this->markerImage->getSize()->getWidthUnit());
        $this->assertSame($heightUnit, $this->markerImage->getSize()->getHeightUnit());
    }

    public function testSizeWithNullValue()
    {
        $this->markerImage->setSize($this->getMock('Ivory\GoogleMap\Base\Size'));
        $this->markerImage->setSize(null);

        $this->assertNull($this->markerImage->getSize());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The size setter arguments is invalid.
     * The available prototypes are :
     * - function setSize(Ivory\GoogleMap\Base\Size $scaledSize = null)
     * - function setSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     */
    public function testSizeWithInvalidValue()
    {
        $this->markerImage->setSize('foo');
    }
}
