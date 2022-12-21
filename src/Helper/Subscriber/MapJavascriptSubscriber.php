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

use Symfony\Contracts\EventDispatcher\Event;
use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Map;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapJavascriptSubscriber extends AbstractDelegateSubscriber
{
    private ?MapRenderer $mapRenderer = null;

    private ?CallbackRenderer $callbackRenderer = null;

    private ?JavascriptTagRenderer $javascriptTagRenderer = null;

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

    public function getMapRenderer(): MapRenderer
    {
        return $this->mapRenderer;
    }

    public function setMapRenderer(MapRenderer $mapRenderer): void
    {
        $this->mapRenderer = $mapRenderer;
    }

    public function getCallbackRenderer(): CallbackRenderer
    {
        return $this->callbackRenderer;
    }

    public function setCallbackRenderer(CallbackRenderer $callbackRenderer): void
    {
        $this->callbackRenderer = $callbackRenderer;
    }

    public function getJavascriptTagRenderer(): JavascriptTagRenderer
    {
        return $this->javascriptTagRenderer;
    }

    public function setJavascriptTagRenderer(JavascriptTagRenderer $javascriptTagRenderer): void
    {
        $this->javascriptTagRenderer = $javascriptTagRenderer;
    }

    public function handle(Event $event, string $eventName, EventDispatcherInterface $eventDispatcher): void
    {
        parent::handle($event, $eventName, $eventDispatcher);

        if ($event instanceof ApiEvent) {
            $this->handleApi($event);
        } elseif ($event instanceof MapEvent) {
            $this->handleMap($event);
        }
    }

    public static function getDelegatedSubscribedEvents(): array
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

    private function handleApi(ApiEvent $event): void
    {
        foreach ($event->getObjects(Map::class) as $map) {
            $event->addLibraries($map->getLibraries());
            $event->addCallback($map, $this->renderCallback($map));
            $event->addRequirement($map, $this->mapRenderer->renderRequirement());
        }
    }

    private function handleMap(MapEvent $event): void
    {
        $formatter = $this->getFormatter();

        $event->setCode($this->javascriptTagRenderer->render($formatter->renderClosure(
            $event->getCode(),
            [],
            $this->renderCallback($event->getMap())
        )));
    }

    private function renderCallback(Map $map): string
    {
        return $this->callbackRenderer->render($map->getVariable());
    }
}
