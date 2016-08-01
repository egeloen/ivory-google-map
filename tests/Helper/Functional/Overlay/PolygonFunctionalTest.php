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
use Ivory\GoogleMap\Overlay\Polygon;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class PolygonFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addPolygon($this->createPolygon());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addPolygon($this->createPolygon());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return Polygon
     */
    private function createPolygon()
    {
        return new Polygon([
            new Coordinate(25.774, -80.190),
            new Coordinate(18.466, -66.118),
            new Coordinate(32.321, -64.757),
            new Coordinate(25.774, -80.190),
        ]);
    }
}
