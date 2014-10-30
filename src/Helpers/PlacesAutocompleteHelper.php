<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Places\Autocomplete;

/**
 * Places autocomplete helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteHelper extends AbstractHelper
{
    /**
     * Renders the autocomplete.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The rendered autocomplete.
     */
    public function render(Autocomplete $autocomplete)
    {
        return $this->renderHtml($autocomplete).$this->renderJavascript($autocomplete);
    }

    /**
     * Renders the html.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The rendered html.
     */
    public function renderHtml(Autocomplete $autocomplete)
    {
        return $this->doRender($autocomplete, PlacesAutocompleteEvents::HTML);
    }

    /**
     * Renders the javascript.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The rendered javascript.
     */
    public function renderJavascript(Autocomplete $autocomplete)
    {
        return $this->doRender($autocomplete, PlacesAutocompleteEvents::JAVASCRIPT);
    }

    /**
     * Does the rendering of a places autocomplete event.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     * @param string                               $eventName    The event name.
     *
     * @return string The rendered places autocomplete event.
     */
    private function doRender(Autocomplete $autocomplete, $eventName)
    {
        $this->getEventDispatcher()->dispatch(
            $eventName,
            $autocompleteEvent = new PlacesAutocompleteEvent($autocomplete)
        );

        return $autocompleteEvent->getCode();
    }
}
