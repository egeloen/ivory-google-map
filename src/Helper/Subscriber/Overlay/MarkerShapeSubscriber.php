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

use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerShapeCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerShapeRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeSubscriber extends AbstractSubscriber
{
    private ?MarkerShapeCollector $markerShapeCollector = null;

    private ?MarkerShapeRenderer $markerShapeRenderer = null;

    public function __construct(
        Formatter $formatter,
        MarkerShapeCollector $markerShapeCollector,
        MarkerShapeRenderer $markerShapeRenderer
    ) {
        parent::__construct($formatter);

        $this->setMarkerShapeCollector($markerShapeCollector);
        $this->setMarkerShapeRenderer($markerShapeRenderer);
    }

    public function getMarkerShapeCollector(): MarkerShapeCollector
    {
        return $this->markerShapeCollector;
    }

    public function setMarkerShapeCollector(MarkerShapeCollector $markerShapeCollector): void
    {
        $this->markerShapeCollector = $markerShapeCollector;
    }

    public function getMarkerShapeRenderer(): MarkerShapeRenderer
    {
        return $this->markerShapeRenderer;
    }

    public function setMarkerShapeRenderer(MarkerShapeRenderer $markerShapeRenderer): void
    {
        $this->markerShapeRenderer = $markerShapeRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getMarkerShapeCollector()->collect($map) as $markerShape) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->markerShapeRenderer->render($markerShape),
                'overlays.marker_shapes',
                $markerShape
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_MARKER_SHAPE => 'handleMap'];
    }
}
