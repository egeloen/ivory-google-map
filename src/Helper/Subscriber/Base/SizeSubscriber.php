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
    private ?SizeCollector $sizeCollector = null;

    private ?SizeRenderer $sizeRenderer = null;

    public function __construct(
        Formatter $formatter,
        SizeCollector $sizeCollector,
        SizeRenderer $sizeRenderer
    ) {
        parent::__construct($formatter);

        $this->setSizeCollector($sizeCollector);
        $this->setSizeRenderer($sizeRenderer);
    }

    public function getSizeCollector(): SizeCollector
    {
        return $this->sizeCollector;
    }

    public function setSizeCollector(SizeCollector $sizeCollector): void
    {
        $this->sizeCollector = $sizeCollector;
    }

    public function getSizeRenderer(): SizeRenderer
    {
        return $this->sizeRenderer;
    }

    public function setSizeRenderer(SizeRenderer $sizeRenderer): void
    {
        $this->sizeRenderer = $sizeRenderer;
    }

    public function handleMap(MapEvent $event): void
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

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_BASE_SIZE => 'handleMap'];
    }
}
