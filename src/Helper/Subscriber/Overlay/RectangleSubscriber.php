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

use Ivory\GoogleMap\Helper\Collector\Overlay\RectangleCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\RectangleRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleSubscriber extends AbstractSubscriber
{
    private ?RectangleCollector $rectangleCollector = null;

    private ?RectangleRenderer $rectangleRenderer = null;

    public function __construct(
        Formatter $formatter,
        RectangleCollector $rectangleCollector,
        RectangleRenderer $rectangleRenderer
    ) {
        parent::__construct($formatter);

        $this->setRectangleCollector($rectangleCollector);
        $this->setRectangleRenderer($rectangleRenderer);
    }

    public function getRectangleCollector(): RectangleCollector
    {
        return $this->rectangleCollector;
    }

    public function setRectangleCollector(RectangleCollector $rectangleCollector): void
    {
        $this->rectangleCollector = $rectangleCollector;
    }

    public function getRectangleRenderer(): RectangleRenderer
    {
        return $this->rectangleRenderer;
    }

    public function setRectangleRenderer(RectangleRenderer $rectangleRenderer): void
    {
        $this->rectangleRenderer = $rectangleRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->rectangleCollector->collect($map) as $rectangle) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->rectangleRenderer->render($rectangle, $map),
                'overlays.rectangles',
                $rectangle
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_RECTANGLE => 'handleMap'];
    }
}
