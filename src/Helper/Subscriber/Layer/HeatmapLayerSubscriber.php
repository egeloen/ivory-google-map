<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Layer;

use Ivory\GoogleMap\Helper\Collector\Layer\HeatmapLayerCollector;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Layer\HeatmapLayerRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerSubscriber extends AbstractSubscriber
{
    /**
     * @var HeatmapLayerCollector
     */
    private $heatmapLayerCollector;

    /**
     * @var HeatmapLayerRenderer
     */
    private $heatmapLayerRenderer;

    /**
     * @param Formatter             $formatter
     * @param HeatmapLayerCollector $heatmapLayerCollector
     * @param HeatmapLayerRenderer  $heatmapLayerRenderer
     */
    public function __construct(
        Formatter $formatter,
        HeatmapLayerCollector $heatmapLayerCollector,
        HeatmapLayerRenderer $heatmapLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setHeatmapLayerCollector($heatmapLayerCollector);
        $this->setHeatmapLayerRenderer($heatmapLayerRenderer);
    }

    /**
     * @return HeatmapLayerCollector
     */
    public function getHeatmapLayerCollector()
    {
        return $this->heatmapLayerCollector;
    }

    /**
     * @param HeatmapLayerCollector $heatmapLayerCollector
     */
    public function setHeatmapLayerCollector(HeatmapLayerCollector $heatmapLayerCollector)
    {
        $this->heatmapLayerCollector = $heatmapLayerCollector;
    }

    /**
     * @return HeatmapLayerRenderer
     */
    public function getHeatmapLayerRenderer()
    {
        return $this->heatmapLayerRenderer;
    }

    /**
     * @param HeatmapLayerRenderer $heatmapLayerRenderer
     */
    public function setHeatmapLayerRenderer(HeatmapLayerRenderer $heatmapLayerRenderer)
    {
        $this->heatmapLayerRenderer = $heatmapLayerRenderer;
    }

    /**
     * @param ApiEvent $event
     */
    public function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $heatmapLayers = $this->heatmapLayerCollector->collect($map);

            if (!empty($heatmapLayers)) {
                $event->addLibrary('visualization');

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

        foreach ($this->heatmapLayerCollector->collect($map) as $heatmapLayer) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->heatmapLayerRenderer->render($heatmapLayer, $map),
                'layers.heatmap_layers',
                $heatmapLayer
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                 => 'handleApi',
            MapEvents::JAVASCRIPT_LAYER_HEATMAP_LAYER => 'handleMap',
        ];
    }
}
