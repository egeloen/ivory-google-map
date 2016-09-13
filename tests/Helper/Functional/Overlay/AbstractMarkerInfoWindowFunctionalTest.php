<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMarkerInfoWindowFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addMarker($this->createMarker());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addMarker($this->createMarker());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return Marker
     */
    protected function createMarker()
    {
        $marker = new Marker(new Coordinate());
        $marker->setInfoWindow($this->createInfoWindowMarker());

        return $marker;
    }

    /**
     * @return InfoWindow
     */
    protected function createInfoWindowMarker()
    {
        return new InfoWindow('content');
    }
}
