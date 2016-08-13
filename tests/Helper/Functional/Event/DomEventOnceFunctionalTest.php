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
class DomEventOnceFunctionalTest extends AbstractDomEventFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getEventManager()->addDomEventOnce($this->createEvent());

        $this->renderMap($map);
        $this->assertMap($map);

        $this->clickSpyButton();
        $this->assertSpyCount(1);

        $this->clickSpyButton();
        $this->assertSpyCount(1);
    }
}
