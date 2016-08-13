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

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteEventOnceCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\EventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteEventOnceSubscriber extends AbstractSubscriber
{
    /**
     * @var AutocompleteEventOnceCollector
     */
    private $eventOnceCollector;

    /**
     * @var EventOnceRenderer
     */
    private $eventOnceRenderer;

    /**
     * @param Formatter                      $formatter
     * @param AutocompleteEventOnceCollector $eventOnceCollector
     * @param EventOnceRenderer              $eventOnceRenderer
     */
    public function __construct(
        Formatter $formatter,
        AutocompleteEventOnceCollector $eventOnceCollector,
        EventOnceRenderer $eventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setEventOnceCollector($eventOnceCollector);
        $this->setEventOnceRenderer($eventOnceRenderer);
    }

    /**
     * @return AutocompleteEventOnceCollector
     */
    public function getEventOnceCollector()
    {
        return $this->eventOnceCollector;
    }

    /**
     * @param AutocompleteEventOnceCollector $eventOnceCollector
     */
    public function setEventOnceCollector(AutocompleteEventOnceCollector $eventOnceCollector)
    {
        $this->eventOnceCollector = $eventOnceCollector;
    }

    /**
     * @return EventOnceRenderer
     */
    public function getEventOnceRenderer()
    {
        return $this->eventOnceRenderer;
    }

    /**
     * @param EventOnceRenderer $eventOnceRenderer
     */
    public function setEventOnceRenderer(EventOnceRenderer $eventOnceRenderer)
    {
        $this->eventOnceRenderer = $eventOnceRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->eventOnceCollector->collect($autocomplete) as $eventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->eventOnceRenderer->render($eventOnce),
                'events.events_once',
                $eventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_EVENT_ONCE => 'handleAutocomplete'];
    }
}
