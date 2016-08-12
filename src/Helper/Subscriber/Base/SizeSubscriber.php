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

use Ivory\GoogleMap\Helper\Collector\Base\SizeCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\SizeRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeSubscriber extends AbstractSubscriber
{
    /**
     * @var SizeCollector
     */
    private $sizeCollector;

    /**
     * @var SizeRenderer
     */
    private $sizeRenderer;

    /**
     * @param Formatter     $formatter
     * @param SizeCollector $sizeCollector
     * @param SizeRenderer  $sizeRenderer
     */
    public function __construct(
        Formatter $formatter,
        SizeCollector $sizeCollector,
        SizeRenderer $sizeRenderer
    ) {
        parent::__construct($formatter);

        $this->setSizeCollector($sizeCollector);
        $this->setSizeRenderer($sizeRenderer);
    }

    /**
     * @return SizeCollector
     */
    public function getSizeCollector()
    {
        return $this->sizeCollector;
    }

    /**
     * @param SizeCollector $sizeCollector
     */
    public function setSizeCollector(SizeCollector $sizeCollector)
    {
        $this->sizeCollector = $sizeCollector;
    }

    /**
     * @return SizeRenderer
     */
    public function getSizeRenderer()
    {
        return $this->sizeRenderer;
    }

    /**
     * @param SizeRenderer $sizeRenderer
     */
    public function setSizeRenderer(SizeRenderer $sizeRenderer)
    {
        $this->sizeRenderer = $sizeRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->sizeCollector->collect($map) as $size) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->sizeRenderer->render($size),
                'base.sizes',
                $size
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_BASE_SIZE => 'handleMap'];
    }
}
