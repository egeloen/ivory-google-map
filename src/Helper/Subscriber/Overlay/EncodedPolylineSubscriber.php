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

use Ivory\GoogleMap\Helper\Collector\Overlay\EncodedPolylineCollector;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\EncodedPolylineRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineSubscriber extends AbstractSubscriber
{
    /**
     * @var EncodedPolylineCollector
     */
    private $encodedPolylineCollector;

    /**
     * @var EncodedPolylineRenderer
     */
    private $encodedPolylineRenderer;

    /**
     * @param Formatter                $formatter
     * @param EncodedPolylineCollector $encodedPolylineCollector
     * @param EncodedPolylineRenderer  $encodedPolylineRenderer
     */
    public function __construct(
        Formatter $formatter,
        EncodedPolylineCollector $encodedPolylineCollector,
        EncodedPolylineRenderer $encodedPolylineRenderer
    ) {
        parent::__construct($formatter);

        $this->setEncodedPolylineCollector($encodedPolylineCollector);
        $this->setEncodedPolylineRenderer($encodedPolylineRenderer);
    }

    /**
     * @return EncodedPolylineCollector
     */
    public function getEncodedPolylineCollector()
    {
        return $this->encodedPolylineCollector;
    }

    /**
     * @param EncodedPolylineCollector $encodedPolylineCollector
     */
    public function setEncodedPolylineCollector(EncodedPolylineCollector $encodedPolylineCollector)
    {
        $this->encodedPolylineCollector = $encodedPolylineCollector;
    }

    /**
     * @return EncodedPolylineRenderer
     */
    public function getEncodedPolylineRenderer()
    {
        return $this->encodedPolylineRenderer;
    }

    /**
     * @param EncodedPolylineRenderer $encodedPolylineRenderer
     */
    public function setEncodedPolylineRenderer(EncodedPolylineRenderer $encodedPolylineRenderer)
    {
        $this->encodedPolylineRenderer = $encodedPolylineRenderer;
    }

    /**
     * @param ApiEvent $event
     */
    public function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $encodedPolylines = $this->encodedPolylineCollector->collect($map);

            if (!empty($encodedPolylines)) {
                $event->addLibrary('geometry');

                break;
            }
        }
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->encodedPolylineCollector->collect($map) as $encodedPolyline) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->encodedPolylineRenderer->render($encodedPolyline, $map),
                'overlays.encoded_polylines',
                $encodedPolyline
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_MAP                      => 'handleApi',
            MapEvents::JAVASCRIPT_OVERLAY_ENCODED_POLYLINE => 'handleMap',
        ];
    }
}
