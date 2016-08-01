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
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerClusterType;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MarkerClustererFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->getMarkerCluster()->setType(MarkerClusterType::MARKER_CLUSTERER);
        $map->getOverlayManager()->addMarker($this->createMarker());
        $map->getOverlayManager()->addMarker($this->createMarker(new Coordinate(1, 1)));
        $map->getOverlayManager()->addMarker($this->createMarker(new Coordinate(2, 2)));

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->getMarkerCluster()->setType(MarkerClusterType::MARKER_CLUSTERER);
        $map->getOverlayManager()->addMarker($this->createMarker());
        $map->getOverlayManager()->addMarker($this->createMarker(new Coordinate(1, 1)));
        $map->getOverlayManager()->addMarker($this->createMarker(new Coordinate(2, 2)));

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @param Coordinate|null $position
     *
     * @return Marker
     */
    private function createMarker(Coordinate $position = null)
    {
        return new Marker($position ?: new Coordinate());
    }
}
