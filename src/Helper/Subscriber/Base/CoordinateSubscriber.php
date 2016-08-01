<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Base;

use Ivory\GoogleMap\Helper\Collector\Base\CoordinateCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateSubscriber extends AbstractSubscriber
{
    /**
     * @var CoordinateCollector
     */
    private $coordinateCollector;

    /**
     * @var CoordinateRenderer
     */
    private $coordinateRenderer;

    /**
     * @param Formatter           $formatter
     * @param CoordinateCollector $coordinateCollector
     * @param CoordinateRenderer  $coordinateRenderer
     */
    public function __construct(
        Formatter $formatter,
        CoordinateCollector $coordinateCollector,
        CoordinateRenderer $coordinateRenderer
    ) {
        parent::__construct($formatter);

        $this->setCoordinateCollector($coordinateCollector);
        $this->setCoordinateRenderer($coordinateRenderer);
    }

    /**
     * @return CoordinateCollector
     */
    public function getCoordinateCollector()
    {
        return $this->coordinateCollector;
    }

    /**
     * @param CoordinateCollector $coordinateCollector
     */
    public function setCoordinateCollector(CoordinateCollector $coordinateCollector)
    {
        $this->coordinateCollector = $coordinateCollector;
    }

    /**
     * @return CoordinateRenderer
     */
    public function getCoordinateRenderer()
    {
        return $this->coordinateRenderer;
    }

    /**
     * @param CoordinateRenderer $coordinateRenderer
     */
    public function setCoordinateRenderer(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->coordinateCollector->collect($map) as $coordinate) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->coordinateRenderer->render($coordinate),
                'base.coordinates',
                $coordinate
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_BASE_COORDINATE => 'handleMap'];
    }
}
