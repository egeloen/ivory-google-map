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
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\ApiRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiJavascriptSubscriber extends AbstractDelegateSubscriber
{
    private ?ApiRenderer $apiRenderer = null;

    private ?JavascriptTagRenderer $javascriptTagRenderer = null;

    public function __construct(
        Formatter $formatter,
        ApiRenderer $apiRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setApiRenderer($apiRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    public function getApiRenderer(): ApiRenderer
    {
        return $this->apiRenderer;
    }

    public function setApiRenderer(ApiRenderer $apiRenderer): void
    {
        $this->apiRenderer = $apiRenderer;
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
        }
    }

    /**
     * @return string[][]
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            ApiEvents::JAVASCRIPT => [
                ApiEvents::JAVASCRIPT_MAP,
                ApiEvents::JAVASCRIPT_AUTOCOMPLETE,
            ],
        ];
    }

    private function handleApi(ApiEvent $event): void
    {
        $event->setCode($this->getJavascriptTagRenderer()->render($this->getApiRenderer()->render(
            $event->getCallbacks(),
            $event->getRequirements(),
            $event->getSources(),
            $event->getLibraries()
        )));
    }
}
