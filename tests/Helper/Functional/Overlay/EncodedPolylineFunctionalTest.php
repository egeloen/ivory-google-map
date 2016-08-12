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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class EncodedPolylineFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addEncodedPolyline($this->createEncodedPolyline());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addEncodedPolyline($this->createEncodedPolyline());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return EncodedPolyline
     */
    private function createEncodedPolyline()
    {
        return new EncodedPolyline('yv_tHizrQiGsR`HcP');
    }
}
