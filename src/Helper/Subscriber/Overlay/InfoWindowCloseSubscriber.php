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

use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoWindowCloseRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCloseSubscriber extends AbstractInfoWindowSubscriber
{
    /**
     * @var InfoWindowCloseRenderer
     */
    private $infoWindowCloseRenderer;

    /**
     * @param Formatter               $formatter
     * @param InfoWindowCollector     $infoWindowCollector
     * @param InfoWindowCloseRenderer $infoWindowCloseRenderer
     */
    public function __construct(
        Formatter $formatter,
        InfoWindowCollector $infoWindowCollector,
        InfoWindowCloseRenderer $infoWindowCloseRenderer
    ) {
        parent::__construct($formatter, $infoWindowCollector);

        $this->setInfoWindowCloseRenderer($infoWindowCloseRenderer);
    }

    /**
     * @return InfoWindowCloseRenderer
     */
    public function getInfoWindowCloseRenderer()
    {
        return $this->infoWindowCloseRenderer;
    }

    /**
     * @param InfoWindowCloseRenderer $infoWindowCloseRenderer
     */
    public function setInfoWindowCloseRenderer(InfoWindowCloseRenderer $infoWindowCloseRenderer)
    {
        $this->infoWindowCloseRenderer = $infoWindowCloseRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();
        $codes = [];

        foreach ($this->getInfoWindowCollector()->collect($map) as $infoWindow) {
            if ($infoWindow->isAutoClose()) {
                $codes[] = $formatter->renderCode($this->infoWindowCloseRenderer->render($infoWindow), true, false);
            }
        }

        $event->addCode($formatter->renderContainerAssignment(
            $map,
            $formatter->renderClosure($formatter->renderLines($codes)),
            'functions.info_windows_close'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_INIT_FUNCTION => 'handleMap'];
    }
}
