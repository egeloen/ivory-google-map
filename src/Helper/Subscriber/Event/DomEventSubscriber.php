<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Event;

use Ivory\GoogleMap\Helper\Collector\Event\DomEventCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventSubscriber extends AbstractSubscriber
{
    private ?DomEventCollector $domEventCollector = null;

    private ?DomEventRenderer $domEventRenderer = null;

    public function __construct(
        Formatter $formatter,
        DomEventCollector $domEventCollector,
        DomEventRenderer $domEventRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventCollector($domEventCollector);
        $this->setDomEventRenderer($domEventRenderer);
    }

    public function getDomEventCollector(): DomEventCollector
    {
        return $this->domEventCollector;
    }

    public function setDomEventCollector(DomEventCollector $domEventCollector): void
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

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->domEventCollector->collect($map) as $domEvent) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->domEventRenderer->render($domEvent),
                'events.dom_events',
                $domEvent
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_EVENT_DOM_EVENT => 'handleMap'];
    }
}
