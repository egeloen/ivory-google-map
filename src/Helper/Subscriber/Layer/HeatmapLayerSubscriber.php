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
    private ?HeatmapLayerCollector $heatmapLayerCollector = null;

    private ?HeatmapLayerRenderer $heatmapLayerRenderer = null;

    public function __construct(
        Formatter $formatter,
        HeatmapLayerCollector $heatmapLayerCollector,
        HeatmapLayerRenderer $heatmapLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setHeatmapLayerCollector($heatmapLayerCollector);
        $this->setHeatmapLayerRenderer($heatmapLayerRenderer);
    }

    public function getHeatmapLayerCollector(): HeatmapLayerCollector
    {
        return $this->heatmapLayerCollector;
    }

    public function setHeatmapLayerCollector(HeatmapLayerCollector $heatmapLayerCollector): void
    {
        $this->heatmapLayerCollector = $heatmapLayerCollector;
    }

    public function getHeatmapLayerRenderer(): HeatmapLayerRenderer
    {
        return $this->heatmapLayerRenderer;
    }

    public function setHeatmapLayerRenderer(HeatmapLayerRenderer $heatmapLayerRenderer): void
    {
        $this->heatmapLayerRenderer = $heatmapLayerRenderer;
    }

    public function handleApi(ApiEvent $event): void
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $heatmapLayers = $this->heatmapLayerCollector->collect($map);

            if (!empty($heatmapLayers)) {
                $event->addLibrary('visualization');

                break;
            }
        }
    }

    public function handleMap(MapEvent $event): void
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
    public static function getSubscribedEvents(): array
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                 => 'handleApi',
            MapEvents::JAVASCRIPT_LAYER_HEATMAP_LAYER => 'handleMap',
        ];
    }
}
