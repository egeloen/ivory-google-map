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

use Ivory\GoogleMap\Helper\Collector\Base\PointCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\PointRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointSubscriber extends AbstractSubscriber
{
    private ?PointCollector $pointCollector = null;

    private ?PointRenderer $pointRenderer = null;

    public function __construct(
        Formatter $formatter,
        PointCollector $pointCollector,
        PointRenderer $pointRenderer
    ) {
        parent::__construct($formatter);

        $this->setPointCollector($pointCollector);
        $this->setPointRenderer($pointRenderer);
    }

    public function getPointCollector(): PointCollector
    {
        return $this->pointCollector;
    }

    public function setPointCollector(PointCollector $pointCollector): void
    {
        $this->pointCollector = $pointCollector;
    }

    public function getPointRenderer(): PointRenderer
    {
        return $this->pointRenderer;
    }

    public function setPointRenderer(PointRenderer $pointRenderer): void
    {
        $this->pointRenderer = $pointRenderer;
    }

    /***
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->pointCollector->collect($map) as $point) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->pointRenderer->render($point),
                'base.points',
                $point
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_BASE_POINT => 'handleMap'];
    }
}
