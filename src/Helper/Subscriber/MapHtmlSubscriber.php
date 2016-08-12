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
use Ivory\GoogleMap\Helper\Renderer\MapHtmlRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHtmlSubscriber extends AbstractSubscriber
{
    /**
     * @var MapHtmlRenderer
     */
    private $mapHtmlRenderer;

    /**
     * @param Formatter       $formatter
     * @param MapHtmlRenderer $mapHtmlRenderer
     */
    public function __construct(Formatter $formatter, MapHtmlRenderer $mapHtmlRenderer)
    {
        parent::__construct($formatter);

        $this->setMapHtmlRenderer($mapHtmlRenderer);
    }

    /**
     * @return MapHtmlRenderer
     */
    public function getMapHtmlRenderer()
    {
        return $this->mapHtmlRenderer;
    }

    /**
     * @param MapHtmlRenderer $mapHtmlRenderer
     */
    public function setMapHtmlRenderer(MapHtmlRenderer $mapHtmlRenderer)
    {
        $this->mapHtmlRenderer = $mapHtmlRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $event->addCode($this->mapHtmlRenderer->render($event->getMap()));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::HTML => 'handleMap'];
    }
}
