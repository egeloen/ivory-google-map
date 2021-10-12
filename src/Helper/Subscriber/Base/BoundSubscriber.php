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

use Ivory\GoogleMap\Helper\Collector\Base\BoundCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\BoundRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundSubscriber extends AbstractSubscriber
{
    private ?BoundCollector $boundCollector = null;

    private ?BoundRenderer $boundRenderer = null;

    public function __construct(
        Formatter $formatter,
        BoundCollector $boundCollector,
        BoundRenderer $boundRenderer
    ) {
        parent::__construct($formatter);

        $this->setBoundCollector($boundCollector);
        $this->setBoundRenderer($boundRenderer);
    }

    public function getBoundCollector(): BoundCollector
    {
        return $this->boundCollector;
    }

    public function setBoundCollector(BoundCollector $boundCollector): void
    {
        $this->boundCollector = $boundCollector;
    }

    public function getBoundRenderer(): BoundRenderer
    {
        return $this->boundRenderer;
    }

    public function setBoundRenderer(BoundRenderer $boundRenderer): void
    {
        $this->boundRenderer = $boundRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->boundCollector->collect($map) as $bound) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->boundRenderer->render($bound),
                'base.bounds',
                $bound
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_BASE_BOUND => 'handleMap'];
    }
}
