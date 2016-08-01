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

use Ivory\GoogleMap\Helper\Collector\Layer\KmlLayerCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Layer\KmlLayerRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerSubscriber extends AbstractSubscriber
{
    /**
     * @var KmlLayerCollector
     */
    private $kmlLayerCollector;

    /**
     * @var KmlLayerRenderer
     */
    private $kmlLayerRenderer;

    /**
     * @param Formatter         $formatter
     * @param KmlLayerCollector $kmlLayerCollector
     * @param KmlLayerRenderer  $kmlLayerRenderer
     */
    public function __construct(
        Formatter $formatter,
        KmlLayerCollector $kmlLayerCollector,
        KmlLayerRenderer $kmlLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setKmlLayerCollector($kmlLayerCollector);
        $this->setKmlLayerRenderer($kmlLayerRenderer);
    }

    /**
     * @return KmlLayerCollector
     */
    public function getKmlLayerCollector()
    {
        return $this->kmlLayerCollector;
    }

    /**
     * @param KmlLayerCollector $kmlLayerCollector
     */
    public function setKmlLayerCollector(KmlLayerCollector $kmlLayerCollector)
    {
        $this->kmlLayerCollector = $kmlLayerCollector;
    }

    /**
     * @return KmlLayerRenderer
     */
    public function getKmlLayerRenderer()
    {
        return $this->kmlLayerRenderer;
    }

    /**
     * @param KmlLayerRenderer $kmlLayerRenderer
     */
    public function setKmlLayerRenderer(KmlLayerRenderer $kmlLayerRenderer)
    {
        $this->kmlLayerRenderer = $kmlLayerRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->kmlLayerCollector->collect($map) as $kmlLayer) {
            $event->addCode($formatter->renderContainerAssignment(
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
        return [MapEvents::JAVASCRIPT_LAYER_KML_LAYER => 'handleMap'];
    }
}
