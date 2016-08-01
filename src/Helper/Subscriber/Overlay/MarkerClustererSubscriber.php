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

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerClustererRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Ivory\GoogleMap\Overlay\MarkerClusterType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClustererSubscriber extends AbstractSubscriber
{
    /**
     * @var MarkerClustererRenderer
     */
    private $markerClustererRenderer;

    /**
     * @param Formatter               $formatter
     * @param MarkerClustererRenderer $markerClustererRenderer
     */
    public function __construct(Formatter $formatter, MarkerClustererRenderer $markerClustererRenderer)
    {
        parent::__construct($formatter);

        $this->setMarkerClustererRenderer($markerClustererRenderer);
    }

    /**
     * @return MarkerClustererRenderer
     */
    public function getMarkerClustererRenderer()
    {
        return $this->markerClustererRenderer;
    }

    /**
     * @param MarkerClustererRenderer $markerClustererRenderer
     */
    public function setMarkerClustererRenderer(MarkerClustererRenderer $markerClustererRenderer)
    {
        $this->markerClustererRenderer = $markerClustererRenderer;
    }

    /**
     * @param ApiEvent $event
     */
    public function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Map::class) as $map) {
            if (($markerCluster = $this->getMarkerCluster($map)) !== null) {
                $event->addSource($this->markerClustererRenderer->renderSource());
                $event->addRequirement($map, $this->markerClustererRenderer->renderRequirement());

                break;
            }
        }
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        if (($markerCluster = $this->getMarkerCluster($map)) !== null) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->markerClustererRenderer->render($markerCluster, $map, $formatter->renderCall(
                    $formatter->renderProperty($formatter->renderContainerVariable($map, 'functions'), 'to_array'),
                    [$formatter->renderContainerVariable($map, 'overlays.markers')]
                )),
                'overlays.marker_cluster'
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                    => 'handleApi',
            MapEvents::JAVASCRIPT_OVERLAY_MARKER_CLUSTER => 'handleMap',
        ];
    }

    /**
     * @param Map $map
     *
     * @return MarkerCluster|null
     */
    private function getMarkerCluster(Map $map)
    {
        $markerCluster = $map->getOverlayManager()->getMarkerCluster();

        if ($markerCluster->getType() === MarkerClusterType::MARKER_CLUSTERER) {
            return $markerCluster;
        }
    }
}
