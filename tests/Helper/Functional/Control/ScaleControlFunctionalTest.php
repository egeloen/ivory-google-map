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
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Control\ScaleControlStyle;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class ScaleControlFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getControlManager()->setScaleControl($this->createScaleControl());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return ScaleControl
     */
    private function createScaleControl()
    {
        return new ScaleControl(ControlPosition::TOP_CENTER, ScaleControlStyle::DEFAULT_);
    }
}
