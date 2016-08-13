<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Place\Event;

use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class AutocompleteDomEventFunctionalTest extends AbstractDomEventFunctionalTest
{
    public function testRender()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addDomEvent($this->createEvent());

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);

        $this->clickSpyButton();
        $this->assertSpyCount(1);

        $this->clickSpyButton();
        $this->assertSpyCount(2);
    }
}
