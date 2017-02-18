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

use Ivory\GoogleMap\Helper\Collector\Image\ExtendableCollector;
use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\Overlay\ExtendableRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableSubscriber implements EventSubscriberInterface
{
    /**
     * @var ExtendableCollector
     */
    private $extendableCollector;

    /**
     * @var ExtendableRenderer
     */
    private $extendableRenderer;

    /**
     * @param ExtendableCollector $extendableCollector
     * @param ExtendableRenderer  $extendableRenderer
     */
    public function __construct(ExtendableCollector $extendableCollector, ExtendableRenderer $extendableRenderer)
    {
        $this->extendableCollector = $extendableCollector;
        $this->extendableRenderer = $extendableRenderer;
    }

    /**
     * @param StaticMapEvent $event
     */
    public function handleMap(StaticMapEvent $event)
    {
        $map = $event->getMap();

        if (!$map->isAutoZoom()) {
            return;
        }

        $extendables = $map->hasStaticOption('visible') ? $map->getStaticOption('visible') : [];

        if (!is_array($extendables)) {
            $extendables = [$extendables];
        }

        $extendables = $this->extendableCollector->collect($map, $extendables);

        if (!empty($extendables)) {
            $event->setParameter('visible', $this->extendableRenderer->render($extendables));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [StaticMapEvents::EXTENDABLE => 'handleMap'];
    }
}
