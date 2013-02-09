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

use Ivory\GoogleMap\Overlays\InfoWindow,
    Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper;

/**
 * Info window helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Overlays\InfoWindowHelper */
    protected $infoWindowHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowHelper = new InfoWindowHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoWindowHelper);
    }

    public function testRenderWithPosition()
    {
        $infoWindow = new InfoWindow();
        $infoWindow->setPosition(1.1, 2.1, true);
        $infoWindow->setPixelOffset(3, 4, 'px', 'px');
        $infoWindow->setContent('content');
        $infoWindow->setOpen(true);
        $infoWindow->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame(
            'var '.$infoWindow->getJavascriptVariable().' = new google.maps.InfoWindow({"position":new google.maps.LatLng(1.1, 2.1, true),"pixelOffset":new google.maps.Size(3, 4, "px", "px"),"content":"content","option1":"value1","option2":"value2"});'.PHP_EOL,
            $this->infoWindowHelper->render($infoWindow, true)
        );
    }

    public function testRenderWithoutPosition()
    {
        $infoWindow = new InfoWindow();
        $infoWindow->setPosition(1.1, 2.1, true);
        $infoWindow->setPixelOffset(3, 4, 'px', 'px');
        $infoWindow->setContent('content');
        $infoWindow->setOpen(true);
        $infoWindow->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame(
            'var '.$infoWindow->getJavascriptVariable().' = new google.maps.InfoWindow({"pixelOffset":new google.maps.Size(3, 4, "px", "px"),"content":"content","option1":"value1","option2":"value2"});'.PHP_EOL,
            $this->infoWindowHelper->render($infoWindow, false)
        );
    }

    public function testRenderOpenWithoutMarker()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $infoWindow->setPosition(1.1, 2.1, true);
        $infoWindow->setContent('content');
        $infoWindow->setOpen(true);
        $infoWindow->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertSame('infoWindow.open(map);'.PHP_EOL, $this->infoWindowHelper->renderOpen($infoWindow, $map));
    }

    public function testRenderOpenWithMarker()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $infoWindow = new InfoWindow();
        $infoWindow->setJavascriptVariable('infoWindow');
        $infoWindow->setPosition(1.1, 2.1, true);
        $infoWindow->setContent('content');
        $infoWindow->setOpen(true);
        $infoWindow->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');
        $marker
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('marker'));

        $this->assertSame(
            'infoWindow.open(map, marker);'.PHP_EOL,
            $this->infoWindowHelper->renderOpen($infoWindow, $map, $marker)
        );
    }
}
