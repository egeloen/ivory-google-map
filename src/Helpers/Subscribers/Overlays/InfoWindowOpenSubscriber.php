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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Info window open subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowOpenSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer */
    private $infoWindowOpenRenderer;

    /**
     * Creates an info window open subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                     $formatter              The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|null $infoWindowAggregator   The info window aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer|null $infoWindowOpenRenderer The info window open renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        InfoWindowAggregator $infoWindowAggregator = null,
        InfoWindowOpenRenderer $infoWindowOpenRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setInfoWindowAggregator($infoWindowAggregator ?: new InfoWindowAggregator());
        $this->setInfoWindowOpenRenderer($infoWindowOpenRenderer ?: new InfoWindowOpenRenderer());
    }

    /**
     * Gets the info window aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator The info window aggregator.
     */
    public function getInfoWindowAggregator()
    {
        return $this->infoWindowAggregator;
    }

    /**
     * Sets the info window aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator $infoWindowAggregator The info window aggregator.
     */
    public function setInfoWindowAggregator(InfoWindowAggregator $infoWindowAggregator)
    {
        $this->infoWindowAggregator = $infoWindowAggregator;
    }

    /**
     * Gets the info window open renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer The info window open renderer.
     */
    public function getInfoWindowOpenRenderer()
    {
        return $this->infoWindowOpenRenderer;
    }

    /**
     * Sets the info window open renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowOpenRenderer $infoWindowOpenRenderer The info window open renderer.
     */
    public function setInfoWindowOpenRenderer(InfoWindowOpenRenderer $infoWindowOpenRenderer)
    {
        $this->infoWindowOpenRenderer = $infoWindowOpenRenderer;
    }

    /**
     * Renders the map javascript finish info window open.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
            if ($infoWindow->isOpen()) {
                $mapEvent->addCode($this->getFormatter()->formatCode(
                    $this->infoWindowOpenRenderer->render($infoWindow, $map)
                ));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_OPEN => 'onMap');
    }
}
