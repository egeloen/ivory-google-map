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
use Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer;

/**
 * Map center subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer */
    private $mapCenterRenderer;

    /**
     * Creates a map center subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null       $formatter         The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer|null $mapCenterRenderer The map center renderer.
     */
    public function __construct(Formatter $formatter = null, MapCenterRenderer $mapCenterRenderer = null)
    {
        parent::__construct($formatter);

        $this->setMapCenterRenderer($mapCenterRenderer ?: new MapCenterRenderer());
    }

    /**
     * Gets the map center renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer The map center renderer.
     */
    public function getMapCenterRenderer()
    {
        return $this->mapCenterRenderer;
    }

    /**
     * Sets the map center renderer.
    *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapCenterRenderer $mapCenterRenderer The map center renderer.
     */
    public function setMapCenterRenderer(MapCenterRenderer $mapCenterRenderer)
    {
        $this->mapCenterRenderer = $mapCenterRenderer;
    }

    /**
     * Renders the map javascript extra center.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        if (!$map->getOverlays()->isAutoZoom()) {
            $mapEvent->addCode($this->getFormatter()->formatCode($this->mapCenterRenderer->render($map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_FINISH_MAP_CENTER => 'onMap');
    }
}
