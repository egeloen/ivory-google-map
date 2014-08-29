<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Base\BoundHelper;

/**
 * Bound helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Base\BoundHelper */
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

    public function testRenderWithEmptyBound()
    {
        $bound = new Bound();
        $bound->setJavascriptVariable('foo');

        $this->assertSame('foo = new google.maps.LatLngBounds();'.PHP_EOL, $this->boundHelper->render($bound));
    }

    public function testRenderWithBound()
    {
        $coordinate1 = new Coordinate(-1.1, -2.1, false);
        $coordinate1->setJavascriptVariable('foo');

        $coordinate2 = new Coordinate(1.1, 2.1, true);
        $coordinate2->setJavascriptVariable('bar');

        $bound = new Bound($coordinate1, $coordinate2);
        $bound->setJavascriptVariable('baz');

        $this->assertSame('baz = new google.maps.LatLngBounds(foo, bar);'.PHP_EOL, $this->boundHelper->render($bound));
    }

    public function testRenderExtends()
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
bound.union(circle.getBounds());
bound.union(groundOverlayBound);
bound.extend(infoWindow.getPosition());
bound.extend(marker.getPosition());
polygon.getPath().forEach(function(element){bound.extend(element)});
polyline.getPath().forEach(function(element){bound.extend(element)});
bound.union(rectangleBound);

EOF;

        $this->assertSame($expected, $this->boundHelper->renderExtends($bound));
    }
}
