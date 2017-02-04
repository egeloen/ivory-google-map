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

use Ivory\GoogleMap\Helper\Collector\Overlay\InfoBoxCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoBoxRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxSubscriber extends AbstractInfoWindowSubscriber
{
    /**
     * @var InfoBoxRenderer
     */
    private $infoBoxRenderer;

    /**
     * @param Formatter        $formatter
     * @param InfoBoxCollector $infoBoxCollector
     * @param InfoBoxRenderer  $infoBoxRenderer
     */
    public function __construct(
        Formatter $formatter,
        InfoBoxCollector $infoBoxCollector,
        InfoBoxRenderer $infoBoxRenderer
    ) {
        parent::__construct($formatter, $infoBoxCollector);

        $this->setInfoBoxRenderer($infoBoxRenderer);
    }

    /**
     * @return InfoBoxRenderer
     */
    public function getInfoBoxRenderer()
    {
        return $this->infoBoxRenderer;
    }

    /**
     * @param InfoBoxRenderer $infoBoxRenderer
     */
    public function setInfoBoxRenderer(InfoBoxRenderer $infoBoxRenderer)
    {
        $this->infoBoxRenderer = $infoBoxRenderer;
    }

    /**
     * @param ApiEvent $event
     */
    public function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $infoBoxes = $this->getInfoWindowCollector()->collect($map);

            if (!empty($infoBoxes)) {
                $event->addSource($this->getInfoBoxRenderer()->renderSource());
                $event->addRequirement($map, $this->getInfoBoxRenderer()->renderRequirement());

                continue;
            }
        }
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();
        $collector = $this->getInfoWindowCollector();

        foreach ($collector->collect($map, [], InfoWindowCollector::STRATEGY_MAP) as $infoWindow) {
            $event->addCode($this->renderInfoBox($map, $infoWindow));
        }

        foreach ($collector->collect($map, [], InfoWindowCollector::STRATEGY_MARKER) as $infoWindow) {
            $event->addCode($this->renderInfoBox($map, $infoWindow, false));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                 => 'handleApi',
            MapEvents::JAVASCRIPT_OVERLAY_INFO_WINDOW => 'handleMap',
        ];
    }

    /**
     * @param Map        $map
     * @param InfoWindow $infoWindow
     * @param bool       $position
     *
     * @return string
     */
    private function renderInfoBox(Map $map, InfoWindow $infoWindow, $position = true)
    {
        return $this->getFormatter()->renderContainerAssignment(
            $map,
            $this->getInfoBoxRenderer()->render($infoWindow, $position),
            'overlays.info_boxes',
            $infoWindow
        );
    }
}
