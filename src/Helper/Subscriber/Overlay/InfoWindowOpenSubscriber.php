<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowOpenRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenSubscriber extends AbstractInfoWindowSubscriber
{
    private ?InfoWindowOpenRenderer $infoWindowOpenRenderer = null;

    public function __construct(
        Formatter $formatter,
        InfoWindowCollector $infoWindowCollector,
        InfoWindowOpenRenderer $infoWindowOpenRenderer
    ) {
        parent::__construct($formatter, $infoWindowCollector);

        $this->setInfoWindowOpenRenderer($infoWindowOpenRenderer);
    }

    public function getInfoWindowOpenRenderer(): InfoWindowOpenRenderer
    {
        return $this->infoWindowOpenRenderer;
    }

    public function setInfoWindowOpenRenderer(InfoWindowOpenRenderer $infoWindowOpenRenderer): void
    {
        $this->infoWindowOpenRenderer = $infoWindowOpenRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getInfoWindowCollector()->collect($map) as $infoWindow) {
            if ($infoWindow->isOpen()) {
                $event->addCode($formatter->renderCode($this->infoWindowOpenRenderer->render($infoWindow, $map)));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_FINISH => 'handleMap'];
    }
}
