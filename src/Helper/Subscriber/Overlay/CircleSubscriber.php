<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\CircleCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\CircleRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleSubscriber extends AbstractSubscriber
{
    private ?CircleCollector $circleCollector = null;

    private ?CircleRenderer $circleRenderer = null;

    public function __construct(
        Formatter $formatter,
        CircleCollector $circleCollector,
        CircleRenderer $circleRenderer
    ) {
        parent::__construct($formatter);

        $this->setCircleCollector($circleCollector);
        $this->setCircleRenderer($circleRenderer);
    }

    public function getCircleCollector(): CircleCollector
    {
        return $this->circleCollector;
    }

    public function setCircleCollector(CircleCollector $circleCollector): void
    {
        $this->circleCollector = $circleCollector;
    }

    public function getCircleRenderer(): CircleRenderer
    {
        return $this->circleRenderer;
    }

    public function setCircleRenderer(CircleRenderer $circleRenderer): void
    {
        $this->circleRenderer = $circleRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->circleCollector->collect($map) as $circle) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->circleRenderer->render($circle, $map),
                'overlays.circles',
                $circle
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_CIRCLE => 'handleMap'];
    }
}
