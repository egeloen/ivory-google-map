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
class AutocompleteEventOnceFunctionalTest extends AbstractEventFunctionalTest
{
    public function testRender()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addEventOnce($this->createEvent($autocomplete->getVariable()));

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);

        $this->byId($autocomplete->getHtmlId())->value('Lille, France');
        $this->selectAutocomplete();
        $this->assertSpyCount(1);

        $this->byId($autocomplete->getHtmlId())->value('Paris, France');
        $this->selectAutocomplete();
        $this->assertSpyCount(1);
    }
}
