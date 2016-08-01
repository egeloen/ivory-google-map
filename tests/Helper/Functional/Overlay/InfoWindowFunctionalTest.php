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
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class InfoWindowFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addInfoWindow($this->createInfoWindow());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addInfoWindow($this->createInfoWindow());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithPixelOffset()
    {
        $infoWindow = $this->createInfoWindow();
        $infoWindow->setPixelOffset(new Size(5, 10));

        $map = new Map();
        $map->getOverlayManager()->addInfoWindow($infoWindow);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return InfoWindow
     */
    private function createInfoWindow()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setPosition(new Coordinate());
        $infoWindow->setOpen(true);

        return $infoWindow;
    }
}
