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
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MixedInfoWindowFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addInfoWindow($this->createInfoWindow());
        $map->getOverlayManager()->addInfoWindow($this->createInfoBox());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addInfoWindow($this->createInfoWindow());
        $map->getOverlayManager()->addInfoWindow($this->createInfoBox());

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

    /**
     * @return InfoWindow
     */
    private function createInfoBox()
    {
        $infoBox = $this->createInfoWindow();
        $infoBox->setType(InfoWindowType::INFO_BOX);
        $infoBox->setPosition(new Coordinate(1, 1));

        return $infoBox;
    }
}
