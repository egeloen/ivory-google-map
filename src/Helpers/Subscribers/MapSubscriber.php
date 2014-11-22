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
use Ivory\GoogleMap\Helpers\Renderers\MapRenderer;

/**
 * Map subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapRenderer */
    private $mapRenderer;

    /**
     * Creates a map subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null $formatter   The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapRenderer|null $mapRenderer The map renderer.
     */
    public function __construct(Formatter $formatter = null, MapRenderer $mapRenderer = null)
    {
        parent::__construct($formatter);

        $this->setMapRenderer($mapRenderer ?: new MapRenderer());
    }

    /**
     * Gets the map renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapRenderer The map renderer.
     */
    public function getMapRenderer()
    {
        return $this->mapRenderer;
    }

    /**
     * Sets the map renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapRenderer $mapRenderer The map renderer.
     */
    public function setMapRenderer(MapRenderer $mapRenderer)
    {
        $this->mapRenderer = $mapRenderer;
    }

    /**
     * Renders the javascript map.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
            $map,
            $this->mapRenderer->render($map),
            'map',
            $map,
            false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_MAP => 'onMap');
    }
}
