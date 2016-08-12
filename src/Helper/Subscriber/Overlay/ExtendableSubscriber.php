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

use Ivory\GoogleMap\Helper\Collector\Overlay\ExtendableCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\ExtendableRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableSubscriber extends AbstractSubscriber
{
    /**
     * @var ExtendableCollector
     */
    private $extendableCollector;

    /**
     * @var ExtendableRenderer
     */
    private $extendableRenderer;

    /**
     * @param Formatter           $formatter
     * @param ExtendableCollector $extendableCollector
     * @param ExtendableRenderer  $extendableRenderer
     */
    public function __construct(
        Formatter $formatter,
        ExtendableCollector $extendableCollector,
        ExtendableRenderer $extendableRenderer
    ) {
        parent::__construct($formatter);

        $this->setExtendableCollector($extendableCollector);
        $this->setExtendableRenderer($extendableRenderer);
    }

    /**
     * @return ExtendableCollector
     */
    public function getExtendableCollector()
    {
        return $this->extendableCollector;
    }

    /**
     * @param ExtendableCollector $extendableCollector
     */
    public function setExtendableCollector(ExtendableCollector $extendableCollector)
    {
        $this->extendableCollector = $extendableCollector;
    }

    /**
     * @return ExtendableRenderer
     */
    public function getExtendableRenderer()
    {
        return $this->extendableRenderer;
    }

    /**
     * @param ExtendableRenderer $extendableRenderer
     */
    public function setExtendableRenderer(ExtendableRenderer $extendableRenderer)
    {
        $this->extendableRenderer = $extendableRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->extendableCollector->collect($map) as $extendable) {
            $event->addCode($formatter->renderCode($this->extendableRenderer->render($extendable, $map->getBound())));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_FINISH => 'handleMap'];
    }
}
