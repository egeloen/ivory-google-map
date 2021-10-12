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

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteDomEventOnceCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteDomEventOnceSubscriber extends AbstractSubscriber
{
    private ?AutocompleteDomEventOnceCollector $domEventOnceCollector = null;

    private ?DomEventOnceRenderer $domEventOnceRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteDomEventOnceCollector $domEventOnceCollector,
        DomEventOnceRenderer $domEventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventOnceCollector($domEventOnceCollector);
        $this->setDomEventOnceRenderer($domEventOnceRenderer);
    }

    public function getDomEventOnceCollector(): AutocompleteDomEventOnceCollector
    {
        return $this->domEventOnceCollector;
    }

    public function setDomEventOnceCollector(AutocompleteDomEventOnceCollector $domEventOnceCollector): void
    {
        $this->domEventOnceCollector = $domEventOnceCollector;
    }

    public function getDomEventOnceRenderer(): DomEventOnceRenderer
    {
        return $this->domEventOnceRenderer;
    }

    public function setDomEventOnceRenderer(DomEventOnceRenderer $domEventOnceRenderer): void
    {
        $this->domEventOnceRenderer = $domEventOnceRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->domEventOnceCollector->collect($autocomplete) as $domEventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->domEventOnceRenderer->render($domEventOnce),
                'events.dom_events_once',
                $domEventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_DOM_EVENT_ONCE => 'handleAutocomplete'];
    }
}
