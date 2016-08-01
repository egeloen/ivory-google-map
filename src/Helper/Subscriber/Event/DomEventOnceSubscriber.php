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

use Ivory\GoogleMap\Helper\Collector\Event\DomEventOnceCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceSubscriber extends AbstractSubscriber
{
    /**
     * @var DomEventOnceCollector
     */
    private $domEventOnceCollector;

    /**
     * @var DomEventOnceRenderer
     */
    private $domEventOnceRenderer;

    /**
     * @param Formatter             $formatter
     * @param DomEventOnceCollector $domEventOnceCollector
     * @param DomEventOnceRenderer  $domEventOnceRenderer
     */
    public function __construct(
        Formatter $formatter,
        DomEventOnceCollector $domEventOnceCollector,
        DomEventOnceRenderer $domEventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventOnceCollector($domEventOnceCollector);
        $this->setDomEventOnceRenderer($domEventOnceRenderer);
    }

    /**
     * @return DomEventOnceCollector
     */
    public function getDomEventOnceCollector()
    {
        return $this->domEventOnceCollector;
    }

    /**
     * @param DomEventOnceCollector $domEventOnceCollector
     */
    public function setDomEventOnceCollector(DomEventOnceCollector $domEventOnceCollector)
    {
        $this->domEventOnceCollector = $domEventOnceCollector;
    }

    /**
     * @return DomEventOnceRenderer
     */
    public function getDomEventOnceRenderer()
    {
        return $this->domEventOnceRenderer;
    }

    /**
     * @param DomEventOnceRenderer $domEventOnceRenderer
     */
    public function setDomEventOnceRenderer(DomEventOnceRenderer $domEventOnceRenderer)
    {
        $this->domEventOnceRenderer = $domEventOnceRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->domEventOnceCollector->collect($map) as $domEventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->domEventOnceRenderer->render($domEventOnce),
                'events.dom_events_once',
                $domEventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_EVENT_DOM_EVENT_ONCE => 'handleMap'];
    }
}
