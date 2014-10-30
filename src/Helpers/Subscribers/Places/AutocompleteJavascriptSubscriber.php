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
use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;

/**
 * Autocomplete javascript subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteJavascriptSubscriber extends AbstractFormatterSubscriber
{
    /**
     * Configures the autocomplete javascript api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        foreach ($apiEvent->getItems(ApiEvent::PLACES_AUTOCOMPLETE) as $autocomplete) {
            $apiEvent->addCallback($this->getFormatter()->formatAssetCallback($autocomplete));
            $apiEvent->addLibrary('places');
        }
    }

    /**
     * Renders the autocomplete javascript.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $placesAutocompleteEvent->getDispatcher()->dispatch(
            PlacesAutocompleteEvents::JAVASCRIPT_INIT,
            $placesAutocompleteEvent
        );

        $placesAutocompleteEvent->getDispatcher()->dispatch(
            PlacesAutocompleteEvents::JAVASCRIPT_BASE,
            $placesAutocompleteEvent
        );

        $placesAutocompleteEvent->getDispatcher()->dispatch(
            PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE,
            $placesAutocompleteEvent
        );

        $placesAutocompleteEvent->setCode($this->getFormatter()->formatJavascript($this->getFormatter()->formatFunction(
            $placesAutocompleteEvent->getCode(),
            array(),
            $this->getFormatter()->formatAssetCallback($placesAutocompleteEvent->getAutocomplete())
        )));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE => 'onApi',
            PlacesAutocompleteEvents::JAVASCRIPT      => 'onAutocomplete',
        );
    }
}
