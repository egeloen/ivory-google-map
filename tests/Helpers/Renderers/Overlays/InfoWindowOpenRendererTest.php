<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Info window open renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer */
    private $infoWindowOpenRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowOpenRenderer = new InfoWindowOpenRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoWindowOpenRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, Marker $marker = null)
    {
        $this->assertSame(
            $expected,
            $this->infoWindowOpenRenderer->render($this->createInfoWindowMock(), $this->createMapMock(), $marker)
        );
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('info_window.open(map)'),
            array('info_window.open(map,marker)', $this->createMarkerMock()),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createInfoWindowMock()
    {
        $infoWindow = parent::createInfoWindowMock();
        $infoWindow
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('info_window'));

        return $infoWindow;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMapMock()
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('map'));

        return $map;
    }

    /**
     * {@inheritdoc}
     */
    protected function createMarkerMock()
    {
        $marker = parent::createMarkerMock();
        $marker
            ->expects($this->any())
            ->method('getVariable')
            ->will($this->returnValue('marker'));

        return $marker;
    }
}
