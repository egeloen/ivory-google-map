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

use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractDomEventFunctionalTest extends AbstractEventFunctionalTest
{
    /**
     * @var string
     */
    private $spyButton;

    protected function setUp(): void
    {
        parent::setUp();

        $this->spyButton = 'spy_button';
    }

    protected function renderAutocomplete(Autocomplete $autocomplete, $html = null)
    {
        return parent::renderAutocomplete($autocomplete, $html ?: '<button id="'.$this->spyButton.'">Button</button>');
    }

    protected function createEvent($instance = null)
    {
        $event = parent::createEvent($instance ?: 'document.getElementById("'.$this->spyButton.'")');
        $event->setTrigger(MouseEvent::CLICK);

        return $event;
    }

    protected function clickSpyButton()
    {
        $this->byId($this->spyButton)->click();
    }
}
