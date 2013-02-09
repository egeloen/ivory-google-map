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

use Ivory\GoogleMap\Overlays\Polygon,
    Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper;

/**
 * Polygon helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\PolygonHelper */
    protected $polygonHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygonHelper = new PolygonHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygonHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper',
            $this->polygonHelper->getCoordinateHelper()
        );
    }

    public function testInitialState()
    {
        $coordinateHelper = $this->getMock('Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper');

        $this->polygonHelper = new PolygonHelper($coordinateHelper);

        $this->assertSame($coordinateHelper, $this->polygonHelper->getCoordinateHelper());
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $polygon = new Polygon();
        $polygon->setJavascriptVariable('polygon');
        $polygon->addCoordinate(1.1, 2.1);
        $polygon->addCoordinate(3.1, 4.2);
        $polygon->addCoordinate(7.4, 12.6);

        $this->assertSame(
            'var polygon = new google.maps.Polygon({"map":map,"paths":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)]});'.PHP_EOL,
            $this->polygonHelper->render($polygon, $map)
        );
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $polygon = new Polygon();
        $polygon->setJavascriptVariable('polygon');
        $polygon->addCoordinate(1.1, 2.1);
        $polygon->addCoordinate(3.1, 4.2);
        $polygon->addCoordinate(7.4, 12.6);
        $polygon->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame(
            'var polygon = new google.maps.Polygon({"map":map,"paths":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)],"option1":"value1","option2":"value2"});'.PHP_EOL,
            $this->polygonHelper->render($polygon, $map)
        );
    }
}
