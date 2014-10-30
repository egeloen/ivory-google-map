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
use Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Autocomplete container subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer */
    private $containerRenderer;

    /**
     * Creates an autocomplete container subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                          $formatter         The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer|null $containerRenderer The container renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        AutocompleteContainerRenderer $containerRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setContainerRenderer($containerRenderer ?: new AutocompleteContainerRenderer());
    }

    /**
     * Gets the container renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer The container renderer.
     */
    public function getContainerRenderer()
    {
        return $this->containerRenderer;
    }

    /**
     * Sets the container renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer $containerRenderer The container renderer.
     */
    public function setContainerRenderer(AutocompleteContainerRenderer $containerRenderer)
    {
        $this->containerRenderer = $containerRenderer;
    }

    /**
     * Renders the autocomplete javascript container.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $autocomplete = $placesAutocompleteEvent->getAutocomplete();

        $placesAutocompleteEvent->addCode($this->getFormatter()->formatContainerAssignment(
            $autocomplete,
            $this->containerRenderer->render($autocomplete)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER => 'onAutocomplete');
    }
}
