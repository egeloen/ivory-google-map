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
    /**
     * @var PointCollector
     */
    private $pointCollector;

    /**
     * @var PointRenderer
     */
    private $pointRenderer;

    /**
     * @param Formatter      $formatter
     * @param PointCollector $pointCollector
     * @param PointRenderer  $pointRenderer
     */
    public function __construct(
        Formatter $formatter,
        PointCollector $pointCollector,
        PointRenderer $pointRenderer
    ) {
        parent::__construct($formatter);

        $this->setPointCollector($pointCollector);
        $this->setPointRenderer($pointRenderer);
    }

    /**
     * @return PointCollector
     */
    public function getPointCollector()
    {
        return $this->pointCollector;
    }

    /**
     * @param PointCollector $pointCollector
     */
    public function setPointCollector(PointCollector $pointCollector)
    {
        $this->pointCollector = $pointCollector;
    }

    /**
     * @return PointRenderer
     */
    public function getPointRenderer()
    {
        return $this->pointRenderer;
    }

    /**
     * @param PointRenderer $pointRenderer
     */
    public function setPointRenderer(PointRenderer $pointRenderer)
    {
        $this->pointRenderer = $pointRenderer;
    }

    /***
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_BASE_POINT => 'handleMap'];
    }
}
