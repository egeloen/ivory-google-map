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
    /**
     * @var GeoJsonLayerCollector
     */
    private $geoJsonLayerCollector;

    /**
     * @var GeoJsonLayerRenderer
     */
    private $geoJsonLayerRenderer;

    /**
     * @param Formatter             $formatter
     * @param GeoJsonLayerCollector $geoJsonLayerCollector
     * @param GeoJsonLayerRenderer  $geoJsonLayerRenderer
     */
    public function __construct(
        Formatter $formatter,
        GeoJsonLayerCollector $geoJsonLayerCollector,
        GeoJsonLayerRenderer $geoJsonLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setGeoJsonLayerCollector($geoJsonLayerCollector);
        $this->setGeoJsonLayerRenderer($geoJsonLayerRenderer);
    }

    /**
     * @return GeoJsonLayerCollector
     */
    public function getGeoJsonLayerCollector()
    {
        return $this->geoJsonLayerCollector;
    }

    /**
     * @param GeoJsonLayerCollector $geoJsonLayerCollector
     */
    public function setGeoJsonLayerCollector(GeoJsonLayerCollector $geoJsonLayerCollector)
    {
        $this->geoJsonLayerCollector = $geoJsonLayerCollector;
    }

    /**
     * @return GeoJsonLayerRenderer
     */
    public function getGeoJsonLayerRenderer()
    {
        return $this->geoJsonLayerRenderer;
    }

    /**
     * @param GeoJsonLayerRenderer $geoJsonLayerRenderer
     */
    public function setGeoJsonLayerRenderer(GeoJsonLayerRenderer $geoJsonLayerRenderer)
    {
        $this->geoJsonLayerRenderer = $geoJsonLayerRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_LAYER_GEO_JSON_LAYER => 'handleMap'];
    }
}
