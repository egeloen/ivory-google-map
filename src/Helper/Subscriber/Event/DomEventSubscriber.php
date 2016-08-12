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
    /**
     * @var DomEventCollector
     */
    private $domEventCollector;

    /**
     * @var DomEventRenderer
     */
    private $domEventRenderer;

    /**
     * @param Formatter         $formatter
     * @param DomEventCollector $domEventCollector
     * @param DomEventRenderer  $domEventRenderer
     */
    public function __construct(
        Formatter $formatter,
        DomEventCollector $domEventCollector,
        DomEventRenderer $domEventRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventCollector($domEventCollector);
        $this->setDomEventRenderer($domEventRenderer);
    }

    /**
     * @return DomEventCollector
     */
    public function getDomEventCollector()
    {
        return $this->domEventCollector;
    }

    /**
     * @param DomEventCollector $domEventCollector
     */
    public function setDomEventCollector(DomEventCollector $domEventCollector)
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
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_EVENT_DOM_EVENT => 'handleMap'];
    }
}
