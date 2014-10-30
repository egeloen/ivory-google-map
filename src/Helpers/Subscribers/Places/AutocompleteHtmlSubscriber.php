<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Places;

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;

/**
 * Autocomplete html subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHtmlSubscriber extends AbstractFormatterSubscriber
{
    /**
     * Renders the autocomplete html.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $autocomplete = $placesAutocompleteEvent->getAutocomplete();

        $attributes = array(
            'id'   => $autocomplete->getInputId(),
            'type' => 'text',
        );

        if ($autocomplete->hasValue()) {
            $attributes['value'] = $autocomplete->getValue();
        }

        $placesAutocompleteEvent->addCode($this->getFormatter()->formatTag(
            'input',
            null,
            array_merge($attributes, $autocomplete->getInputAttributes()),
            true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(PlacesAutocompleteEvents::HTML => 'onAutocomplete');
    }
}
