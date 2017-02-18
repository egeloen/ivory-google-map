<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Image;

use Ivory\GoogleMap\Helper\Collector\Image\MarkerCollector;
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\MarkerRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerSubscriber implements EventSubscriberInterface
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * @var MarkerRenderer
     */
    private $markerRenderer;

    /**
     * @param MarkerCollector $markerCollector
     * @param MarkerRenderer  $markerRenderer
     */
    public function __construct(MarkerCollector $markerCollector, MarkerRenderer $markerRenderer)
    {
        $this->markerCollector = $markerCollector;
        $this->markerRenderer = $markerRenderer;
    }

    /**
     * @param StaticMapEvent $event
     */
    public function handleMap(StaticMapEvent $event)
    {
        $result = [];

        foreach ($this->markerCollector->collect($event->getMap()) as $markers) {
            $result[] = $this->markerRenderer->render($markers);
        }

        if (!empty($result)) {
            $event->setParameter('markers', $result);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [StaticMapEvents::MARKER => 'handleMap'];
    }
}
