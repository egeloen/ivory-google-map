<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Overlays;

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;
use Ivory\GoogleMap\Overlays\MarkerClusterType;

/**
 * Marker cluster subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer */
    private $markerClusterRenderer;

    /**
     * Creates a marker cluster subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                    $formatter             The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer|null $markerClusterRenderer The marker cluster renderer.
     */
    public function __construct(Formatter $formatter = null, MarkerClusterRenderer $markerClusterRenderer = null)
    {
        parent::__construct($formatter);

        $this->setMarkerClusterRenderer($markerClusterRenderer ?: new MarkerClusterRenderer());
    }

    /**
     * Gets the marker cluster renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer The marker cluster renderer.
     */
    public function getMarkerClusterRenderer()
    {
        return $this->markerClusterRenderer;
    }

    /**
     * Sets the marker cluster renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\MarkerClusterRenderer $markerClusterRenderer The marker cluster renderer.
     */
    public function setMarkerClusterRenderer(MarkerClusterRenderer $markerClusterRenderer)
    {
        $this->markerClusterRenderer = $markerClusterRenderer;
    }

    /**
     * Configures the map javascript marker cluster api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        foreach ($apiEvent->getItems(ApiEvent::MAP) as $map) {
            if ($map->getOverlays()->getMarkerCluster()->getType() === MarkerClusterType::MARKER_CLUSTER) {
                $apiEvent->addSource($this->markerClusterRenderer->renderSource());
            }
        }
    }

    /**
     * Renders the map javascript overlays marker cluster.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();
        $markerCluster = $map->getOverlays()->getMarkerCluster();

        if ($markerCluster->getType() === MarkerClusterType::MARKER_CLUSTER) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->markerClusterRenderer->render(
                    $map->getOverlays()->getMarkerCluster(),
                    $map,
                    $this->getFormatter()->formatFunctionCall(
                        $this->getFormatter()->formatContainerVariable($map, 'functions.to_array'),
                        array($this->getFormatter()->formatContainerVariable($map, 'overlays.markers')),
                        false,
                        false
                    )
                ),
                'overlays.marker_cluster',
                $markerCluster,
                false
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ApiEvents::JAVASCRIPT_MAP_MARKER_CLUSTER      => 'onApi',
            MapEvents::JAVASCRIPT_OVERLAYS_MARKER_CLUSTER => 'onMap',
        );
    }
}
