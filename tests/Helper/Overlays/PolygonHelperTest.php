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

use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Helper\Overlays\PolygonHelper;

/**
 * Polygon helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\PolygonHelper */
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

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $coordinate->setJavascriptVariable('coordinate'.$index);
        }

        $this->assertSame(
            'polygon = new google.maps.Polygon({"map":map,"paths":[coordinate0,coordinate1,coordinate2]});'.PHP_EOL,
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

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $coordinate->setJavascriptVariable('coordinate'.$index);
        }

        $polygon->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = 'polygon = new google.maps.Polygon({'.
            '"map":map,'.
            '"paths":['.
            'coordinate0,'.
            'coordinate1,'.
            'coordinate2'.
            '],'.
            '"option1":"value1",'.
            '"option2":"value2"'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->polygonHelper->render($polygon, $map));
    }
}
