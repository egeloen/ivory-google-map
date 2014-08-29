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

use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Helper\Overlays\PolylineHelper;

/**
 * Polyline helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Overlays\PolylineHelper */
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

        foreach ($polyline->getCoordinates() as $index => $coordinate) {
            $coordinate->setJavascriptVariable('coordinate'.$index);
        }

        $this->assertSame(
            'polyline = new google.maps.Polyline({"map":map,"path":[coordinate0,coordinate1,coordinate2]});'.PHP_EOL,
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

        foreach ($polyline->getCoordinates() as $index => $coordinate) {
            $coordinate->setJavascriptVariable('coordinate'.$index);
        }

        $polyline->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = 'polyline = new google.maps.Polyline({'.
            '"map":map,'.
            '"path":['.
            'coordinate0,'.
            'coordinate1,'.
            'coordinate2'.
            '],'.
            '"option1":"value1",'.
            '"option2":"value2"'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->polylineHelper->render($polyline, $map));
    }
}
