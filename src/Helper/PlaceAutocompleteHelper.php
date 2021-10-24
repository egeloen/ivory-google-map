<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelper extends AbstractHelper
{
    public function render(Autocomplete $autocomplete): string
    {
        return $this->renderHtml($autocomplete) . $this->renderJavascript($autocomplete);
    }

    public function renderHtml(Autocomplete $autocomplete): string
    {
        return $this->doRender($autocomplete, PlaceAutocompleteEvents::HTML);
    }

    public function renderJavascript(Autocomplete $autocomplete): string
    {
        return $this->doRender($autocomplete, PlaceAutocompleteEvents::JAVASCRIPT);
    }

    /**
     * @param string $eventName
     *
     */
    private function doRender(Autocomplete $autocomplete, $eventName): ?string
    {
        $this->getEventDispatcher()->dispatch($event = new PlaceAutocompleteEvent($autocomplete), $eventName);

        return $event->getCode();
    }
}
