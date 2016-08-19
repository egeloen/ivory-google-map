<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Map;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapJavascriptSubscriber extends AbstractDelegateSubscriber
{
    /**
     * @var MapRenderer
     */
    private $mapRenderer;

    /**
     * @var CallbackRenderer
     */
    private $callbackRenderer;

    /**
     * @var JavascriptTagRenderer
     */
    private $javascriptTagRenderer;

    /**
     * @param Formatter             $formatter
     * @param MapRenderer           $mapRenderer
     * @param CallbackRenderer      $callbackRenderer
     * @param JavascriptTagRenderer $javascriptTagRenderer
     */
    public function __construct(
        Formatter $formatter,
        MapRenderer $mapRenderer,
        CallbackRenderer $callbackRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setMapRenderer($mapRenderer);
        $this->setCallbackRenderer($callbackRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    /**
     * @return MapRenderer
     */
    public function getMapRenderer()
    {
        return $this->mapRenderer;
    }

    /**
     * @param MapRenderer $mapRenderer
     */
    public function setMapRenderer(MapRenderer $mapRenderer)
    {
        $this->mapRenderer = $mapRenderer;
    }

    /**
     * @return CallbackRenderer
     */
    public function getCallbackRenderer()
    {
        return $this->callbackRenderer;
    }

    /**
     * @param CallbackRenderer $callbackRenderer
     */
    public function setCallbackRenderer(CallbackRenderer $callbackRenderer)
    {
        $this->callbackRenderer = $callbackRenderer;
    }

    /**
     * @return JavascriptTagRenderer
     */
    public function getJavascriptTagRenderer()
    {
        return $this->javascriptTagRenderer;
    }

    /**
     * @param JavascriptTagRenderer $javascriptTagRenderer
     */
    public function setJavascriptTagRenderer(JavascriptTagRenderer $javascriptTagRenderer)
    {
        $this->javascriptTagRenderer = $javascriptTagRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Event $event, $eventName, EventDispatcherInterface $eventDispatcher)
    {
        parent::handle($event, $eventName, $eventDispatcher);

        if ($event instanceof ApiEvent) {
            $this->handleApi($event);
        } elseif ($event instanceof MapEvent) {
            $this->handleMap($event);
        }
    }

    /**
     * @return string
     */
    public static function getDelegatedSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_MAP => [],
            MapEvents::JAVASCRIPT     => [
                MapEvents::JAVASCRIPT_INIT,
                MapEvents::JAVASCRIPT_BASE,
                MapEvents::JAVASCRIPT_MAP,
                MapEvents::JAVASCRIPT_OVERLAY,
                MapEvents::JAVASCRIPT_LAYER,
                MapEvents::JAVASCRIPT_CONTROL,
                MapEvents::JAVASCRIPT_EVENT,
                MapEvents::JAVASCRIPT_FINISH,
            ],
        ];
    }

    /**
     * @param ApiEvent $event
     */
    private function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $event->addLibraries($map->getLibraries());
            $event->addCallback($map, $this->renderCallback($map));
            $event->addRequirement($map, $this->mapRenderer->renderRequirement());
        }
    }

    /**
     * @param MapEvent $event
     */
    private function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();

        $event->setCode($this->javascriptTagRenderer->render($formatter->renderClosure(
            $event->getCode(),
            [],
            $this->renderCallback($event->getMap())
        )));
    }

    /**
     * @param Map $map
     *
     * @return string
     */
    private function renderCallback(Map $map)
    {
        return $this->callbackRenderer->render($map->getVariable());
    }
}
