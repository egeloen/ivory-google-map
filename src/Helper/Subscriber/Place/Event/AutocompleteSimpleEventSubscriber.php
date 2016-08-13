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

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteSimpleEventSubscriber extends AbstractSubscriber
{
    /**
     * @var AutocompleteEventCollector
     */
    private $eventCollector;

    /**
     * @var EventRenderer
     */
    private $eventRenderer;

    /**
     * @param Formatter                  $formatter
     * @param AutocompleteEventCollector $eventCollector
     * @param EventRenderer              $eventRenderer
     */
    public function __construct(
        Formatter $formatter,
        AutocompleteEventCollector $eventCollector,
        EventRenderer $eventRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventCollector($eventCollector);
        $this->setEventRenderer($eventRenderer);
    }

    /**
     * @return AutocompleteEventCollector
     */
    public function getEventCollector()
    {
        return $this->eventCollector;
    }

    /**
     * @param AutocompleteEventCollector $eventCollector
     */
    public function setEventCollector(AutocompleteEventCollector $eventCollector)
    {
        $this->eventCollector = $eventCollector;
    }

    /**
     * @return EventRenderer
     */
    public function getEventRenderer()
    {
        return $this->eventRenderer;
    }

    /**
     * @param EventRenderer $eventRenderer
     */
    public function setEventRenderer(EventRenderer $eventRenderer)
    {
        $this->eventRenderer = $eventRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->eventCollector->collect($autocomplete) as $rawEvent) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->eventRenderer->render($rawEvent),
                'events.events',
                $rawEvent
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_EVENT => 'handleAutocomplete'];
    }
}
