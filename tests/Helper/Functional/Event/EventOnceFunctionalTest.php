<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Event;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class EventOnceFunctionalTest extends AbstractEventFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getEventManager()->addEventOnce($this->createEvent($map->getVariable()));

        $this->renderMap($map);
        $this->assertMap($map);

        $this->byId($map->getHtmlId())->click();
        $this->assertSpyCount(1);

        $this->byId($map->getHtmlId())->click();
        $this->assertSpyCount(1);
    }
}
