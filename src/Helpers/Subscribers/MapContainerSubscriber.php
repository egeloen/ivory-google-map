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
use Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer;

/**
 * Map container subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer */
    private $containerRenderer;

    /**
     * Creates a container subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null          $formatter         The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer|null $containerRenderer The container renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        MapContainerRenderer $containerRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setContainerRenderer($containerRenderer ?: new MapContainerRenderer());
    }

    /**
     * Gets the container renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer The container renderer.
     */
    public function getContainerRenderer()
    {
        return $this->containerRenderer;
    }

    /**
     * Sets the container renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapContainerRenderer $containerRenderer The container renderer.
     */
    public function setContainerRenderer(MapContainerRenderer $containerRenderer)
    {
        $this->containerRenderer = $containerRenderer;
    }

    /**
     * Renders the map javascript container.
     *
     * @param \Ivory\GoogleMap\Helpers\MapEvent $mapEvent The map event.
     */
    public function onMap(MapEvent $mapEvent)
    {
        $map = $mapEvent->getMap();

        $mapEvent->addCode($this->getFormatter()->formatContainerAssignment(
            $map,
            $this->containerRenderer->render(array(
                '[info_windows][close]' => $this->getFormatter()->formatFunction(
                    null,
                    array(),
                    null,
                    false,
                    false,
                    false
                ),
                '[to_array]'            => $this->getFormatter()->formatFunction(
                    'var a=[];for(var k in o){a.push(o[k]);}return a;',
                    array('o'),
                    null,
                    false,
                    false,
                    false
                ),
            ))
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(MapEvents::JAVASCRIPT_INIT_CONTAINER => 'onMap');
    }
}
