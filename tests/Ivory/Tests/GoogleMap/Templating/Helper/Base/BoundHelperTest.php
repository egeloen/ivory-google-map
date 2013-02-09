<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Base;

use Ivory\GoogleMap\Base\Coordinate,
    Ivory\GoogleMap\Base\Bound,
    Ivory\GoogleMap\Templating\Helper\Base\BoundHelper;

/**
 * Bound helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper */
    protected $boundHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundHelper = new BoundHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper',
            $this->boundHelper->getCoordinateHelper()
        );
    }

    public function testInitialState()
    {
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper');
        $this->boundHelper = new BoundHelper($coordinateHelper);

        $this->assertSame($coordinateHelper, $this->boundHelper->getCoordinateHelper());
    }

    public function testRenderWithEmptyBound()
    {
        $bound = new Bound();
        $bound->setJavascriptVariable('foo');

        $this->assertSame('var foo = new google.maps.LatLngBounds();'.PHP_EOL, $this->boundHelper->render($bound));
    }

    public function testRenderWithBound()
    {
        $bound = new Bound(new Coordinate(-1.1, -2.1, false), new Coordinate(1.1, 2.1, true));
        $bound->setJavascriptVariable('foo');

        $this->assertSame(
            'var foo = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, false), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL,
            $this->boundHelper->render($bound)
        );
    }

    public function testRenderWithExtends()
    {
        $bound = new Bound();
        $bound->setJavascriptVariable('bound');

        $circle = $this->getMock('Ivory\GoogleMap\Overlays\Circle');
        $circle
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('circle'));

        $groundOverlayBound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $groundOverlayBound
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('groundOverlayBound'));

        $groundOverlay = $this->getMock('Ivory\GoogleMap\Overlays\GroundOverlay');
        $groundOverlay
            ->expects($this->once())
            ->method('getBound')
            ->will($this->returnValue($groundOverlayBound));

        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');
        $infoWindow
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('infoWindow'));

        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');
        $marker
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('marker'));

        $polygon = $this->getMock('Ivory\GoogleMap\Overlays\Polygon');
        $polygon
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('polygon'));

        $polyline = $this->getMock('Ivory\GoogleMap\Overlays\Polyline');
        $polyline
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('polyline'));

        $rectangleBound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $rectangleBound
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('rectangleBound'));

        $rectangle = $this->getMock('Ivory\GoogleMap\Overlays\Rectangle');
        $rectangle
            ->expects($this->once())
            ->method('getBound')
            ->will($this->returnValue($rectangleBound));

        $bound->extend($circle);
        $bound->extend($groundOverlay);
        $bound->extend($infoWindow);
        $bound->extend($marker);
        $bound->extend($polygon);
        $bound->extend($polyline);
        $bound->extend($rectangle);

        $expected = <<<EOF
var bound = new google.maps.LatLngBounds();
bound.union(circle.getBounds());
bound.union(groundOverlayBound);
bound.extend(infoWindow.getPosition());
bound.extend(marker.getPosition());
polygon.getPath().forEach(function(element){bound.extend(element)});
polyline.getPath().forEach(function(element){bound.extend(element)});
bound.union(rectangleBound);

EOF;

        $this->assertSame($expected, $this->boundHelper->render($bound));
    }
}
