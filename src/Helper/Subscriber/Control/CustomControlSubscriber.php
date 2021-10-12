<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Control;

use Ivory\GoogleMap\Helper\Collector\Control\CustomControlCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Control\CustomControlRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlSubscriber extends AbstractSubscriber
{
    private ?CustomControlCollector $customControlCollector = null;

    private ?CustomControlRenderer $customControlRenderer = null;

    public function __construct(
        Formatter $formatter,
        CustomControlCollector $customControlCollector,
        CustomControlRenderer $customControlRenderer
    ) {
        parent::__construct($formatter);

        $this->setCustomControlCollector($customControlCollector);
        $this->setCustomControlRenderer($customControlRenderer);
    }

    public function getCustomControlCollector(): CustomControlCollector
    {
        return $this->customControlCollector;
    }

    public function setCustomControlCollector(CustomControlCollector $customControlCollector): void
    {
        $this->customControlCollector = $customControlCollector;
    }

    public function getCustomControlRenderer(): CustomControlRenderer
    {
        return $this->customControlRenderer;
    }

    public function setCustomControlRenderer(CustomControlRenderer $customControlRenderer): void
    {
        $this->customControlRenderer = $customControlRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->customControlCollector->collect($map) as $customControl) {
            $event->addCode($formatter->renderCode($this->customControlRenderer->render($customControl, $map)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_CONTROL_CUSTOM => 'handleMap'];
    }
}
