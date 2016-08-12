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
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Control\MapTypeControlStyle;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MapTypeControlFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->setMapOption('mapTypeId', MapTypeId::HYBRID);
        $map->getControlManager()->setMapTypeControl($this->createMapTypeControl());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return MapTypeControl
     */
    private function createMapTypeControl()
    {
        return new MapTypeControl(
            [MapTypeId::HYBRID],
            ControlPosition::TOP_CENTER,
            MapTypeControlStyle::DROPDOWN_MENU
        );
    }
}
