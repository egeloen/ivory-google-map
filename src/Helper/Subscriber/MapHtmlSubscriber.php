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
    private ?MapHtmlRenderer $mapHtmlRenderer = null;

    public function __construct(Formatter $formatter, MapHtmlRenderer $mapHtmlRenderer)
    {
        parent::__construct($formatter);

        $this->setMapHtmlRenderer($mapHtmlRenderer);
    }

    public function getMapHtmlRenderer(): MapHtmlRenderer
    {
        return $this->mapHtmlRenderer;
    }

    public function setMapHtmlRenderer(MapHtmlRenderer $mapHtmlRenderer): void
    {
        $this->mapHtmlRenderer = $mapHtmlRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $event->addCode($this->mapHtmlRenderer->render($event->getMap()));
    }

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::HTML => 'handleMap'];
    }
}
