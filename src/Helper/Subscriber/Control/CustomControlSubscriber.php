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
    /**
     * @var CustomControlCollector
     */
    private $customControlCollector;

    /**
     * @var CustomControlRenderer
     */
    private $customControlRenderer;

    /**
     * @param Formatter              $formatter
     * @param CustomControlCollector $customControlCollector
     * @param CustomControlRenderer  $customControlRenderer
     */
    public function __construct(
        Formatter $formatter,
        CustomControlCollector $customControlCollector,
        CustomControlRenderer $customControlRenderer
    ) {
        parent::__construct($formatter);

        $this->setCustomControlCollector($customControlCollector);
        $this->setCustomControlRenderer($customControlRenderer);
    }

    /**
     * @return CustomControlCollector
     */
    public function getCustomControlCollector()
    {
        return $this->customControlCollector;
    }

    /**
     * @param CustomControlCollector $customControlCollector
     */
    public function setCustomControlCollector(CustomControlCollector $customControlCollector)
    {
        $this->customControlCollector = $customControlCollector;
    }

    /**
     * @return CustomControlRenderer
     */
    public function getCustomControlRenderer()
    {
        return $this->customControlRenderer;
    }

    /**
     * @param CustomControlRenderer $customControlRenderer
     */
    public function setCustomControlRenderer(CustomControlRenderer $customControlRenderer)
    {
        $this->customControlRenderer = $customControlRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
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
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_CONTROL_CUSTOM => 'handleMap'];
    }
}
