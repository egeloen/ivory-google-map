<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\MapEvent;
use Ivory\GoogleMap\Helpers\MapEvents;
use Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer;

/**
 * Map bound subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer */
    private $mapBoundRenderer;

    /**
     * Creates a map bound subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null      $formatter        The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer|null $mapBoundRenderer The map bound renderer.
     */
    public function __construct(Formatter $formatter = null, MapBoundRenderer $mapBoundRenderer = null)
    {
        parent::__construct($formatter);

        $this->setMapBoundRenderer($mapBoundRenderer ?: new MapBoundRenderer());
    }

    /**
     * Gets the map bound renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer The map bound renderer.
     */
    public function getMapBoundRenderer()
    {
        return $this->mapBoundRenderer;
    }

    /**
     * Sets the map bound renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapBoundRenderer $mapBoundRenderer The map bound renderer.
     */
    public function setMapBoundRenderer(MapBoundRenderer $mapBoundRenderer)
    {
        $this->mapBoundRenderer = $mapBoundRenderer;
    }

    /**
     * Renders the map javascript bound.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        if ($map->getOverlays()->isAutoZoom()) {
            $mapEvent->addCode($this->getFormatter()->formatCode($this->mapBoundRenderer->render($map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH_MAP_BOUND => 'onMap');
    }
}
