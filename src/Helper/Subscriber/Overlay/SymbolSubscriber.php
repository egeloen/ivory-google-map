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

use Ivory\GoogleMap\Helper\Collector\Overlay\SymbolCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\SymbolRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymbolSubscriber extends AbstractSubscriber
{
    private ?SymbolCollector $symbolCollector = null;

    private ?SymbolRenderer $symbolRenderer = null;

    public function __construct(
        Formatter $formatter,
        SymbolCollector $symbolCollector,
        SymbolRenderer $symbolRenderer
    ) {
        parent::__construct($formatter);

        $this->setSymbolCollector($symbolCollector);
        $this->setSymbolRenderer($symbolRenderer);
    }

    public function getSymbolCollector(): SymbolCollector
    {
        return $this->symbolCollector;
    }

    public function setSymbolCollector(SymbolCollector $symbolCollector): void
    {
        $this->symbolCollector = $symbolCollector;
    }

    public function getSymbolRenderer(): SymbolRenderer
    {
        return $this->symbolRenderer;
    }

    public function setSymbolRenderer(SymbolRenderer $symbolRenderer): void
    {
        $this->symbolRenderer = $symbolRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getSymbolCollector()->collect($map) as $symbol) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->symbolRenderer->render($symbol),
                'overlays.symbols',
                $symbol
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_SYMBOL => 'handleMap'];
    }
}
