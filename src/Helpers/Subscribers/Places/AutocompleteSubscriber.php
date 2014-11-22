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
use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Autocomplete subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer */
    private $autocompleteRenderer;

    /**
     * Creates an autocomplete subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter            The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer|null $autocompleteRenderer The autocomplete renderer.
     */
    public function __construct(Formatter $formatter = null, AutocompleteRenderer $autocompleteRenderer = null)
    {
        parent::__construct($formatter);

        $this->setAutocompleteRenderer($autocompleteRenderer ?: new AutocompleteRenderer());
    }

    /**
     * Gets the autocomplete renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer The autocomplete renderer.
     */
    public function getAutocompleteRenderer()
    {
        return $this->autocompleteRenderer;
    }

    /**
     * Sets the autocomplete renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer $autocompleteRenderer The autocomplete renderer.
     */
    public function setAutocompleteRenderer(AutocompleteRenderer $autocompleteRenderer)
    {
        $this->autocompleteRenderer = $autocompleteRenderer;
    }

    /**
     * Renders the places autocomplete javascript.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $autocomplete = $placesAutocompleteEvent->getAutocomplete();

        $placesAutocompleteEvent->addCode($this->getFormatter()->formatContainerAssignment(
            $autocomplete,
            $this->autocompleteRenderer->render($autocomplete),
            'autocomplete',
            $autocomplete,
            false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE => 'onAutocomplete');
    }
}
