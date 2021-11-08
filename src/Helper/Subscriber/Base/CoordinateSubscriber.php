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
    private ?CoordinateCollector $coordinateCollector = null;

    private ?CoordinateRenderer $coordinateRenderer = null;

    public function __construct(
        Formatter $formatter,
        CoordinateCollector $coordinateCollector,
        CoordinateRenderer $coordinateRenderer
    ) {
        parent::__construct($formatter);

        $this->setCoordinateCollector($coordinateCollector);
        $this->setCoordinateRenderer($coordinateRenderer);
    }

    public function getCoordinateCollector(): CoordinateCollector
    {
        return $this->coordinateCollector;
    }

    public function setCoordinateCollector(CoordinateCollector $coordinateCollector): void
    {
        $this->coordinateCollector = $coordinateCollector;
    }

    public function getCoordinateRenderer(): CoordinateRenderer
    {
        return $this->coordinateRenderer;
    }

    public function setCoordinateRenderer(CoordinateRenderer $coordinateRenderer): void
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    public function handleMap(MapEvent $event): void
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

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_BASE_COORDINATE => 'handleMap'];
    }
}
