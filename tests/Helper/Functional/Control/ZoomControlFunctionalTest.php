<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Control;

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Control\ZoomControlStyle;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class ZoomControlFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getControlManager()->setZoomControl($this->createZoomControl());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return ZoomControl
     */
    private function createZoomControl()
    {
        return new ZoomControl(ControlPosition::TOP_CENTER, ZoomControlStyle::LARGE);
    }
}
