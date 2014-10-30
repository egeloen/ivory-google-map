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

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator;
use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Icon subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator */
    private $iconAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer */
    private $iconRenderer;

    /**
     * Creates an icon subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null               $formatter      The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator|null $iconAggregator The icon aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer|null     $iconRenderer   The icon renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        IconAggregator $iconAggregator = null,
        IconRenderer $iconRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setIconAggregator($iconAggregator ?: new IconAggregator());
        $this->setIconRenderer($iconRenderer ?: new IconRenderer());
    }

    /**
     * Gets the icon aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator The icon aggregator.
     */
    public function getIconAggregator()
    {
        return $this->iconAggregator;
    }

    /**
     * Sets the icon aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator $iconAggregator The icon aggregator.
     */
    public function setIconAggregator(IconAggregator $iconAggregator)
    {
        $this->iconAggregator = $iconAggregator;
    }

    /**
     * Gets the icon renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer The icon renderer.
     */
    public function getIconRenderer()
    {
        return $this->iconRenderer;
    }

    /**
     * Sets the icon renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\IconRenderer $iconRenderer The icon renderer.
     */
    public function setIconRenderer(IconRenderer $iconRenderer)
    {
        $this->iconRenderer = $iconRenderer;
    }

    /**
     * Renders the map javascript overlays icons.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        foreach ($this->iconAggregator->aggregate($map) as $icon) {
            $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
                $map,
                $this->iconRenderer->render($icon),
                'overlays.icons',
                $icon
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_OVERLAYS_ICON => 'onMap');
    }
}
