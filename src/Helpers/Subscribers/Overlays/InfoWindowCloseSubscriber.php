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
use Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Info window close subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer */
    private $infoWindowCloseRenderer;

    /**
     * Creates an info window close subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                      $formatter               The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|null  $infoWindowAggregator    The info window aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer|null $infoWindowCloseRenderer The info window close renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        InfoWindowAggregator $infoWindowAggregator = null,
        InfoWindowCloseRenderer $infoWindowCloseRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setInfoWindowAggregator($infoWindowAggregator ?: new InfoWindowAggregator());
        $this->setInfoWindowCloseRenderer($infoWindowCloseRenderer ?: new InfoWindowCloseRenderer());
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
     * Gets the info window close renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer The info window close renderer.
     */
    public function getInfoWindowCloseRenderer()
    {
        return $this->infoWindowCloseRenderer;
    }

    /**
     * Sets the info window close renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\InfoWindowCloseRenderer $infoWindowCloseRenderer The info window close renderer.
     */
    public function setInfoWindowCloseRenderer(InfoWindowCloseRenderer $infoWindowCloseRenderer)
    {
        $this->infoWindowCloseRenderer = $infoWindowCloseRenderer;
    }

    /**
     * Renders the map javascript finish info window close.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();
        $code = null;

        foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
            if ($infoWindow->isAutoClose()) {
                $code .= $this->getFormatter()->formatCode(
                    $this->infoWindowCloseRenderer->render($infoWindow)
                );
            }
        }

        if (!empty($code)) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->getFormatter()->formatFunction($code, array(), null, false, true, false),
                'functions.info_windows.close'
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH_INFO_WINDOW_CLOSE => 'onMap');
    }
}
