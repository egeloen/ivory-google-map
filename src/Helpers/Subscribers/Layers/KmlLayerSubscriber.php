<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Layers;

use Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Kml layer subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator */
    private $kmlLayerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer */
    private $kmlLayerRenderer;

    /**
     * Creates a kml layer subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                 $formatter          The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator|null $kmlLayerAggregator The kml layer aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer|null     $kmlLayerRenderer   The kml layer renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        KmlLayerAggregator $kmlLayerAggregator = null,
        KmlLayerRenderer $kmlLayerRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setKmlLayerAggregator($kmlLayerAggregator ?: new KmlLayerAggregator());
        $this->setKmlLayerRenderer($kmlLayerRenderer ?: new KmlLayerRenderer());
    }

    /**
     * Gets the kml layer aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator The kml layer aggregator.
     */
    public function getKmlLayerAggregator()
    {
        return $this->kmlLayerAggregator;
    }

    /**
     * Sets the kml layer aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator $kmlLayerAggregator The kml layer aggregator.
     */
    public function setKmlLayerAggregator(KmlLayerAggregator $kmlLayerAggregator)
    {
        $this->kmlLayerAggregator = $kmlLayerAggregator;
    }

    /**
     * Gets the kml layer renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer The kml layer renderer.
     */
    public function getKmlLayerRenderer()
    {
        return $this->kmlLayerRenderer;
    }

    /**
     * Sets the kml layer renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Layers\KmlLayerRenderer $kmlLayerRenderer The kml layer renderer.
     */
    public function setKmlLayerRenderer(KmlLayerRenderer $kmlLayerRenderer)
    {
        $this->kmlLayerRenderer = $kmlLayerRenderer;
    }

    /**
     * Renders the map javascript layers kml layers.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->kmlLayerAggregator->aggregate($map) as $kmlLayer) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->kmlLayerRenderer->render($kmlLayer, $map),
                'layers.kml_layers',
                $kmlLayer
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_LAYERS_KML_LAYER => 'onMap');
    }
}
