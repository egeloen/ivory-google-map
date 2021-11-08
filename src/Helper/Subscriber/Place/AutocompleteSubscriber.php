<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place;

use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteSubscriber extends AbstractSubscriber
{
    private ?AutocompleteRenderer $autocompleteRenderer = null;

    public function __construct(Formatter $formatter, AutocompleteRenderer $autocompleteRenderer)
    {
        parent::__construct($formatter);

        $this->setAutocompleteRenderer($autocompleteRenderer);
    }

    public function getAutocompleteRenderer(): AutocompleteRenderer
    {
        return $this->autocompleteRenderer;
    }

    public function setAutocompleteRenderer(AutocompleteRenderer $autocompleteRenderer): void
    {
        $this->autocompleteRenderer = $autocompleteRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $autocomplete = $event->getAutocomplete();

        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $autocomplete,
            $this->autocompleteRenderer->render($autocomplete),
            'autocomplete'
        ));
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE => 'handleAutocomplete'];
    }
}
