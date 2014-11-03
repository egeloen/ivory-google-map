<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Overlays\Legend;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerImage;
use Ivory\GoogleMap\Helper\Overlays\LegendHelper;
use Ivory\GoogleMap\Map;

/**
 * Marker helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LegendHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\LegendHelper */
    protected $legendHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->legendHelper = new LegendHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->legendHelper);
    }

    public function testRenderJs()
    {
        $map = new Map();
        $map->setJavascriptVariable('myMap');

        $map->setLegend(new Legend());

        $expected = 'google.maps.event.addListenerOnce(myMap, \'idle\', function(){document.getElementById(\'map_legend\').style.display = "block";});' . PHP_EOL .
                    'myMap.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById(\'map_legend\'));' . PHP_EOL;

        $this->assertEquals($expected, $this->legendHelper->render($map));
    }

    public function testRenderHtmlNoMarker()
    {
        $map = new Map();
        $map->setJavascriptVariable('myMap');

        $map->setLegend(new Legend());

        $expected = '<div id="map_legend" style="display:none; "></div>';

        $this->assertEquals($expected, $this->legendHelper->renderHtmlContainer($map));
    }

    public function testRenderHtmlOneMarker()
    {
        $map = new Map();

        $marker = new Marker();
        $markerIcon = new MarkerImage();
        $markerIcon->setName('test');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $map->setLegend(new Legend());

        $expected = '<div id="map_legend" style="display:none; "><div><img style="vertical-align:middle" src="//maps.gstatic.com/mapfiles/markers/marker.png" alt="test" /><span>test</span></div></div>';

        $this->assertEquals($expected, $this->legendHelper->renderHtmlContainer($map));
    }

    public function testRenderHtmlOneImageMultipleMarker()
    {
        $map = new Map();

        $marker = new Marker();
        $markerIcon = new MarkerImage();
        $markerIcon->setName('test');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $marker = new Marker();
        $markerIcon->setUrl('//google.com/');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $map->setLegend(new Legend());

        $expected = '<div id="map_legend" style="display:none; "><div><img style="vertical-align:middle" src="//google.com/" alt="test" /><span>test</span></div></div>';

        $this->assertEquals($expected, $this->legendHelper->renderHtmlContainer($map));
    }

    public function testRenderHtmlMultipleMarker()
    {
        $map = new Map();

        $marker = new Marker();
        $markerIcon = new MarkerImage();
        $markerIcon->setName('test');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $marker = new Marker();
        $markerIcon = new MarkerImage();
        $markerIcon->setName('test2');
        $markerIcon->setUrl('//google.com/');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $map->setLegend(new Legend());

        $expected = '<div id="map_legend" style="display:none; "><div><img style="vertical-align:middle" src="//maps.gstatic.com/mapfiles/markers/marker.png" alt="test" /><span>test</span></div><div><img style="vertical-align:middle" src="//google.com/" alt="test2" /><span>test2</span></div></div>';

        $this->assertEquals($expected, $this->legendHelper->renderHtmlContainer($map));
    }

    public function testRenderHtmlLegendWithStyle()
    {
        $map = new Map();

        $marker = new Marker();
        $markerIcon = new MarkerImage();
        $markerIcon->setName('test');
        $marker->setIcon($markerIcon);
        $map->addMarker($marker);

        $legend = new Legend();
        $legend->setStyles(array('color' => 'red', 'border' => '1px solid black'));
        $map->setLegend($legend);

        $expected = '<div id="map_legend" style="display:none; color: red;border: 1px solid black;"><div><img style="vertical-align:middle" src="//maps.gstatic.com/mapfiles/markers/marker.png" alt="test" /><span>test</span></div></div>';

        $this->assertEquals($expected, $this->legendHelper->renderHtmlContainer($map));
    }
}
