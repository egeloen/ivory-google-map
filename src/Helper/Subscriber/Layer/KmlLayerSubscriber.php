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
    private ?KmlLayerCollector $kmlLayerCollector = null;

    private ?KmlLayerRenderer $kmlLayerRenderer = null;

    public function __construct(
        Formatter $formatter,
        KmlLayerCollector $kmlLayerCollector,
        KmlLayerRenderer $kmlLayerRenderer
    ) {
        parent::__construct($formatter);

        $this->setKmlLayerCollector($kmlLayerCollector);
        $this->setKmlLayerRenderer($kmlLayerRenderer);
    }

    public function getKmlLayerCollector(): KmlLayerCollector
    {
        return $this->kmlLayerCollector;
    }

    public function setKmlLayerCollector(KmlLayerCollector $kmlLayerCollector): void
    {
        $this->kmlLayerCollector = $kmlLayerCollector;
    }

    public function getKmlLayerRenderer(): KmlLayerRenderer
    {
        return $this->kmlLayerRenderer;
    }

    public function setKmlLayerRenderer(KmlLayerRenderer $kmlLayerRenderer): void
    {
        $this->kmlLayerRenderer = $kmlLayerRenderer;
    }

    public function handleMap(MapEvent $event): void
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
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_LAYER_KML_LAYER => 'handleMap'];
    }
}
