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
class AutocompleteEventFunctionalTest extends AbstractEventFunctionalTest
{
    public function testRender()
    {
        $autocomplete = new Autocomplete();
        $autocomplete->getEventManager()->addEvent($this->createEvent($autocomplete->getVariable()));

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);

        $element = $this->byId($autocomplete->getHtmlId());

        $element->value('Lille, France');
        $this->selectAutocomplete();
        $this->assertSpyCount(1);

        $element->clear();

        $element->value('Paris, France');
        $this->selectAutocomplete();
        $this->assertSpyCount(2);
    }
}
