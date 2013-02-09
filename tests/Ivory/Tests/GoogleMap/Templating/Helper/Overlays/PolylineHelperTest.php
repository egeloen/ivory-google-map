<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Overlays\Polyline,
    Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper;

/**
 * Polyline helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\PolylineHelper */
    protected $polylineHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineHelper = new PolylineHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polylineHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper',
            $this->polylineHelper->getCoordinateHelper()
        );
    }

    public function testInitialState()
    {
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper');

        $this->polylineHelper = new PolylineHelper($coordinateHelper);

        $this->assertSame($coordinateHelper, $this->polylineHelper->getCoordinateHelper());
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $polyline = new Polyline();
        $polyline->setJavascriptVariable('polyline');
        $polyline->addCoordinate(1.1, 2.1);
        $polyline->addCoordinate(3.1, 4.2);
        $polyline->addCoordinate(7.4, 12.6);

        $this->assertSame(
            'var polyline = new google.maps.Polyline({"map":map,"path":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)]});'.PHP_EOL,
            $this->polylineHelper->render($polyline, $map)
        );
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $polyline = new Polyline();
        $polyline->setJavascriptVariable('polyline');
        $polyline->addCoordinate(1.1, 2.1);
        $polyline->addCoordinate(3.1, 4.2);
        $polyline->addCoordinate(7.4, 12.6);
        $polyline->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame(
            'var polyline = new google.maps.Polyline({"map":map,"path":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)],"option1":"value1","option2":"value2"});'.PHP_EOL,
            $this->polylineHelper->render($polyline, $map)
        );
    }
}
