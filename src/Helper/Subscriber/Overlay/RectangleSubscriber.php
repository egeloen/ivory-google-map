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
    /**
     * @var RectangleCollector
     */
    private $rectangleCollector;

    /**
     * @var RectangleRenderer
     */
    private $rectangleRenderer;

    /**
     * @param Formatter          $formatter
     * @param RectangleCollector $rectangleCollector
     * @param RectangleRenderer  $rectangleRenderer
     */
    public function __construct(
        Formatter $formatter,
        RectangleCollector $rectangleCollector,
        RectangleRenderer $rectangleRenderer
    ) {
        parent::__construct($formatter);

        $this->setRectangleCollector($rectangleCollector);
        $this->setRectangleRenderer($rectangleRenderer);
    }

    /**
     * @return RectangleCollector
     */
    public function getRectangleCollector()
    {
        return $this->rectangleCollector;
    }

    /**
     * @param RectangleCollector $rectangleCollector
     */
    public function setRectangleCollector(RectangleCollector $rectangleCollector)
    {
        $this->rectangleCollector = $rectangleCollector;
    }

    /**
     * @return RectangleRenderer
     */
    public function getRectangleRenderer()
    {
        return $this->rectangleRenderer;
    }

    /**
     * @param RectangleRenderer $rectangleRenderer
     */
    public function setRectangleRenderer(RectangleRenderer $rectangleRenderer)
    {
        $this->rectangleRenderer = $rectangleRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_RECTANGLE => 'handleMap'];
    }
}
