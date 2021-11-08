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

use Ivory\GoogleMap\Helper\Collector\Overlay\GroundOverlayCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\GroundOverlayRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlaySubscriber extends AbstractSubscriber
{
    private ?GroundOverlayCollector $groundOverlayCollector = null;

    private ?GroundOverlayRenderer $groundOverlayRenderer = null;

    public function __construct(
        Formatter $formatter,
        GroundOverlayCollector $groundOverlayCollector,
        GroundOverlayRenderer $groundOverlayRenderer
    ) {
        parent::__construct($formatter);

        $this->setGroundOverlayCollector($groundOverlayCollector);
        $this->setGroundOverlayRenderer($groundOverlayRenderer);
    }

    public function getGroundOverlayCollector(): GroundOverlayCollector
    {
        return $this->groundOverlayCollector;
    }

    public function setGroundOverlayCollector(GroundOverlayCollector $groundOverlayCollector): void
    {
        $this->groundOverlayCollector = $groundOverlayCollector;
    }

    public function getGroundOverlayRenderer(): GroundOverlayRenderer
    {
        return $this->groundOverlayRenderer;
    }

    public function setGroundOverlayRenderer(GroundOverlayRenderer $groundOverlayRenderer): void
    {
        $this->groundOverlayRenderer = $groundOverlayRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->groundOverlayCollector->collect($map) as $groundOverlay) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->groundOverlayRenderer->render($groundOverlay, $map),
                'overlays.ground_overlays',
                $groundOverlay
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_GROUND_OVERLAY => 'handleMap'];
    }
}
