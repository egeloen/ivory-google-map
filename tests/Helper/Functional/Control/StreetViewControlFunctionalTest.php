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
use Ivory\GoogleMap\Control\StreetViewControl;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class StreetViewControlFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getControlManager()->setStreetViewControl($this->createStreetViewControl());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return StreetViewControl
     */
    private function createStreetViewControl()
    {
        return new StreetViewControl(ControlPosition::TOP_CENTER);
    }
}
