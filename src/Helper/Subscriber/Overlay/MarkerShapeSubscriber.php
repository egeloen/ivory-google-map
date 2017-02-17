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
    /**
     * @var MarkerShapeCollector
     */
    private $markerShapeCollector;

    /**
     * @var MarkerShapeRenderer
     */
    private $markerShapeRenderer;

    /**
     * @param Formatter            $formatter
     * @param MarkerShapeCollector $markerShapeCollector
     * @param MarkerShapeRenderer  $markerShapeRenderer
     */
    public function __construct(
        Formatter $formatter,
        MarkerShapeCollector $markerShapeCollector,
        MarkerShapeRenderer $markerShapeRenderer
    ) {
        parent::__construct($formatter);

        $this->setMarkerShapeCollector($markerShapeCollector);
        $this->setMarkerShapeRenderer($markerShapeRenderer);
    }

    /**
     * @return MarkerShapeCollector
     */
    public function getMarkerShapeCollector()
    {
        return $this->markerShapeCollector;
    }

    /**
     * @param MarkerShapeCollector $markerShapeCollector
     */
    public function setMarkerShapeCollector(MarkerShapeCollector $markerShapeCollector)
    {
        $this->markerShapeCollector = $markerShapeCollector;
    }

    /**
     * @return MarkerShapeRenderer
     */
    public function getMarkerShapeRenderer()
    {
        return $this->markerShapeRenderer;
    }

    /**
     * @param MarkerShapeRenderer $markerShapeRenderer
     */
    public function setMarkerShapeRenderer(MarkerShapeRenderer $markerShapeRenderer)
    {
        $this->markerShapeRenderer = $markerShapeRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_MARKER_SHAPE => 'handleMap'];
    }
}
