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
    /**
     * @var SymbolCollector
     */
    private $symbolCollector;

    /**
     * @var SymbolRenderer
     */
    private $symbolRenderer;

    /**
     * @param Formatter       $formatter
     * @param SymbolCollector $symbolCollector
     * @param SymbolRenderer  $symbolRenderer
     */
    public function __construct(
        Formatter $formatter,
        SymbolCollector $symbolCollector,
        SymbolRenderer $symbolRenderer
    ) {
        parent::__construct($formatter);

        $this->setSymbolCollector($symbolCollector);
        $this->setSymbolRenderer($symbolRenderer);
    }

    /**
     * @return SymbolCollector
     */
    public function getSymbolCollector()
    {
        return $this->symbolCollector;
    }

    /**
     * @param SymbolCollector $symbolCollector
     */
    public function setSymbolCollector(SymbolCollector $symbolCollector)
    {
        $this->symbolCollector = $symbolCollector;
    }

    /**
     * @return SymbolRenderer
     */
    public function getSymbolRenderer()
    {
        return $this->symbolRenderer;
    }

    /**
     * @param SymbolRenderer $symbolRenderer
     */
    public function setSymbolRenderer(SymbolRenderer $symbolRenderer)
    {
        $this->symbolRenderer = $symbolRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_SYMBOL => 'handleMap'];
    }
}
