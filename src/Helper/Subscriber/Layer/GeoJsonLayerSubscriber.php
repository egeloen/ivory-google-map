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

use Ivory\GoogleMap\Helper\Collector\Layer\GeoJsonLayerCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Layer\GeoJsonLayerRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerSubscriber extends AbstractSubscriber
{
    private ?GeoJsonLayerCollector $geoJsonLayerCollector = null;

    private ?GeoJsonLayerRenderer $geoJsonLayerRenderer = null;

    public function __construct(
        Formatter $formatter,
        GeoJsonLayerCollector $geoJsonLayerCollector,
        GeoJsonLayerRenderer $geoJsonLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setGeoJsonLayerCollector($geoJsonLayerCollector);
        $this->setGeoJsonLayerRenderer($geoJsonLayerRenderer);
    }

    public function getGeoJsonLayerCollector(): GeoJsonLayerCollector
    {
        return $this->geoJsonLayerCollector;
    }

    public function setGeoJsonLayerCollector(GeoJsonLayerCollector $geoJsonLayerCollector): void
    {
        $this->geoJsonLayerCollector = $geoJsonLayerCollector;
    }

    public function getGeoJsonLayerRenderer(): GeoJsonLayerRenderer
    {
        return $this->geoJsonLayerRenderer;
    }

    public function setGeoJsonLayerRenderer(GeoJsonLayerRenderer $geoJsonLayerRenderer): void
    {
        $this->geoJsonLayerRenderer = $geoJsonLayerRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->geoJsonLayerCollector->collect($map) as $geoJsonLayer) {
            $event->addCode($formatter->renderCode($this->geoJsonLayerRenderer->render($geoJsonLayer, $map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_LAYER_GEO_JSON_LAYER => 'handleMap'];
    }
}
