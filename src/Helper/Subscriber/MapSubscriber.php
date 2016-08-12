<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapSubscriber extends AbstractSubscriber
{
    /**
     * @var MapRenderer
     */
    private $mapRenderer;

    /**
     * @param Formatter   $formatter
     * @param MapRenderer $mapRenderer
     */
    public function __construct(Formatter $formatter, MapRenderer $mapRenderer)
    {
        parent::__construct($formatter);

        $this->setMapRenderer($mapRenderer);
    }

    /**
     * @return MapRenderer
     */
    public function getMapRenderer()
    {
        return $this->mapRenderer;
    }

    /**
     * @param MapRenderer $mapRenderer
     */
    public function setMapRenderer(MapRenderer $mapRenderer)
    {
        $this->mapRenderer = $mapRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();

        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $map,
            $this->mapRenderer->render($map),
            'map'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_MAP => 'handleMap'];
    }
}
