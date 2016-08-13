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
    /**
     * @var AutocompleteDomEventCollector
     */
    private $domEventCollector;

    /**
     * @var DomEventRenderer
     */
    private $domEventRenderer;

    /**
     * @param Formatter                     $formatter
     * @param AutocompleteDomEventCollector $domEventCollector
     * @param DomEventRenderer              $domEventRenderer
     */
    public function __construct(
        Formatter $formatter,
        AutocompleteDomEventCollector $domEventCollector,
        DomEventRenderer $domEventRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventCollector($domEventCollector);
        $this->setDomEventRenderer($domEventRenderer);
    }

    /**
     * @return AutocompleteDomEventCollector
     */
    public function getDomEventCollector()
    {
        return $this->domEventCollector;
    }

    /**
     * @param AutocompleteDomEventCollector $domEventCollector
     */
    public function setDomEventCollector(AutocompleteDomEventCollector $domEventCollector)
    {
        $this->domEventCollector = $domEventCollector;
    }

    /**
     * @return DomEventRenderer
     */
    public function getDomEventRenderer()
    {
        return $this->domEventRenderer;
    }

    /**
     * @param DomEventRenderer $domEventRenderer
     */
    public function setDomEventRenderer(DomEventRenderer $domEventRenderer)
    {
        $this->domEventRenderer = $domEventRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
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

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_DOM_EVENT => 'handleAutocomplete'];
    }
}
