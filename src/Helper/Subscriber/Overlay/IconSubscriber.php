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

use Ivory\GoogleMap\Helper\Collector\Overlay\IconCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSubscriber extends AbstractSubscriber
{
    /**
     * @var IconCollector
     */
    private $iconCollector;

    /**
     * @var IconRenderer
     */
    private $iconRenderer;

    /**
     * @param Formatter     $formatter
     * @param IconCollector $iconCollector
     * @param IconRenderer  $iconRenderer
     */
    public function __construct(
        Formatter $formatter,
        IconCollector $iconCollector,
        IconRenderer $iconRenderer
    ) {
        parent::__construct($formatter);

        $this->setIconCollector($iconCollector);
        $this->setIconRenderer($iconRenderer);
    }

    /**
     * @return IconCollector
     */
    public function getIconCollector()
    {
        return $this->iconCollector;
    }

    /**
     * @param IconCollector $iconCollector
     */
    public function setIconCollector(IconCollector $iconCollector)
    {
        $this->iconCollector = $iconCollector;
    }

    /**
     * @return IconRenderer
     */
    public function getIconRenderer()
    {
        return $this->iconRenderer;
    }

    /**
     * @param IconRenderer $iconRenderer
     */
    public function setIconRenderer(IconRenderer $iconRenderer)
    {
        $this->iconRenderer = $iconRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getIconCollector()->collect($map) as $icon) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->iconRenderer->render($icon),
                'overlays.icons',
                $icon
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_ICON => 'handleMap'];
    }
}
