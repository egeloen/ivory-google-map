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

use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerRenderer;
use Ivory\GoogleMap\Overlay\MarkerClusterType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerSubscriber extends AbstractMarkerSubscriber
{
    /**
     * @var MarkerRenderer
     */
    private $markerRenderer;

    /**
     * @param Formatter       $formatter
     * @param MarkerCollector $markerCollector
     * @param MarkerRenderer  $markerRenderer
     */
    public function __construct(
        Formatter $formatter,
        MarkerCollector $markerCollector,
        MarkerRenderer $markerRenderer
    ) {
        parent::__construct($formatter, $markerCollector);

        $this->setMarkerRenderer($markerRenderer);
    }

    /**
     * @return MarkerRenderer
     */
    public function getMarkerRenderer()
    {
        return $this->markerRenderer;
    }

    /**
     * @param MarkerRenderer $markerRenderer
     */
    public function setMarkerRenderer(MarkerRenderer $markerRenderer)
    {
        $this->markerRenderer = $markerRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();
        $markerMap = null;

        if ($map->getOverlayManager()->getMarkerCluster()->getType() === MarkerClusterType::DEFAULT_) {
            $markerMap = $map;
        }

        foreach ($this->getMarkerCollector()->collect($map) as $marker) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->markerRenderer->render($marker, $markerMap),
                'overlays.markers',
                $marker
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_MARKER => 'handleMap'];
    }
}
