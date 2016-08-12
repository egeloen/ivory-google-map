<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\MapContainerRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapContainerSubscriber extends AbstractSubscriber
{
    /**
     * @var MapContainerRenderer
     */
    private $containerRenderer;

    /**
     * @param Formatter            $formatter
     * @param MapContainerRenderer $containerRenderer
     */
    public function __construct(Formatter $formatter, MapContainerRenderer $containerRenderer)
    {
        parent::__construct($formatter);

        $this->setContainerRenderer($containerRenderer);
    }

    /**
     * @return MapContainerRenderer
     */
    public function getContainerRenderer()
    {
        return $this->containerRenderer;
    }

    /**
     * @param MapContainerRenderer $containerRenderer
     */
    public function setContainerRenderer(MapContainerRenderer $containerRenderer)
    {
        $this->containerRenderer = $containerRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        $event->addCode($formatter->renderContainerAssignment(
            $map,
            $this->containerRenderer->render()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_INIT_CONTAINER => 'handleMap'];
    }
}
