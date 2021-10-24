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
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteContainerRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerSubscriber extends AbstractSubscriber
{
    private ?AutocompleteContainerRenderer $containerRenderer = null;

    public function __construct(Formatter $formatter, AutocompleteContainerRenderer $containerRenderer)
    {
        parent::__construct($formatter);

        $this->setContainerRenderer($containerRenderer);
    }

    public function getContainerRenderer(): AutocompleteContainerRenderer
    {
        return $this->containerRenderer;
    }

    public function setContainerRenderer(AutocompleteContainerRenderer $containerRenderer): void
    {
        $this->containerRenderer = $containerRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $autocomplete = $event->getAutocomplete();

        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $autocomplete,
            $this->containerRenderer->render()
        ));
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER => 'handleAutocomplete'];
    }
}
