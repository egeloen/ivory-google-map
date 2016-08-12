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
    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    public function render(Autocomplete $autocomplete)
    {
        return $this->renderHtml($autocomplete).$this->renderJavascript($autocomplete);
    }

    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    public function renderHtml(Autocomplete $autocomplete)
    {
        return $this->doRender($autocomplete, PlaceAutocompleteEvents::HTML);
    }

    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    public function renderJavascript(Autocomplete $autocomplete)
    {
        return $this->doRender($autocomplete, PlaceAutocompleteEvents::JAVASCRIPT);
    }

    /**
     * @param Autocomplete $autocomplete
     * @param string       $eventName
     *
     * @return string
     */
    private function doRender(Autocomplete $autocomplete, $eventName)
    {
        $this->getEventDispatcher()->dispatch($eventName, $event = new PlaceAutocompleteEvent($autocomplete));

        return $event->getCode();
    }
}
