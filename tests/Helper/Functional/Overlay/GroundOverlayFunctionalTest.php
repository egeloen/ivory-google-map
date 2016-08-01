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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class GroundOverlayFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addGroundOverlay($this->createGroundOverlay());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addGroundOverlay($this->createGroundOverlay());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return GroundOverlay
     */
    private function createGroundOverlay()
    {
        return new GroundOverlay(
            'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
            new Bound(new Coordinate(40.712216, -74.22655), new Coordinate(40.773941, -74.12544))
        );
    }
}
