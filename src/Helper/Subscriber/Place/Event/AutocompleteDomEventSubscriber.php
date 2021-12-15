<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place\Event;

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteDomEventCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteDomEventSubscriber extends AbstractSubscriber
{
    private ?AutocompleteDomEventCollector $domEventCollector = null;

    private ?DomEventRenderer $domEventRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteDomEventCollector $domEventCollector,
        DomEventRenderer $domEventRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventCollector($domEventCollector);
        $this->setDomEventRenderer($domEventRenderer);
    }

    public function getDomEventCollector(): AutocompleteDomEventCollector
    {
        return $this->domEventCollector;
    }

    public function setDomEventCollector(AutocompleteDomEventCollector $domEventCollector): void
    {
        $this->domEventCollector = $domEventCollector;
    }

    public function getDomEventRenderer(): DomEventRenderer
    {
        return $this->domEventRenderer;
    }

    public function setDomEventRenderer(DomEventRenderer $domEventRenderer): void
    {
        $this->domEventRenderer = $domEventRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->domEventCollector->collect($autocomplete) as $domEvent) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->domEventRenderer->render($domEvent),
                'events.dom_events',
                $domEvent
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_DOM_EVENT => 'handleAutocomplete'];
    }
}
