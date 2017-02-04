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
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\ApiRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiJavascriptSubscriber extends AbstractDelegateSubscriber
{
    /**
     * @var ApiRenderer
     */
    private $apiRenderer;

    /**
     * @var JavascriptTagRenderer
     */
    private $javascriptTagRenderer;

    /**
     * @param Formatter             $formatter
     * @param ApiRenderer           $apiRenderer
     * @param JavascriptTagRenderer $javascriptTagRenderer
     */
    public function __construct(
        Formatter $formatter,
        ApiRenderer $apiRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setApiRenderer($apiRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    /**
     * @return ApiRenderer
     */
    public function getApiRenderer()
    {
        return $this->apiRenderer;
    }

    /**
     * @param ApiRenderer $apiRenderer
     */
    public function setApiRenderer(ApiRenderer $apiRenderer)
    {
        $this->apiRenderer = $apiRenderer;
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
        }
    }

    /**
     * @return string[][]
     */
    public static function getDelegatedSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT => [
                ApiEvents::JAVASCRIPT_MAP,
                ApiEvents::JAVASCRIPT_AUTOCOMPLETE,
            ],
        ];
    }

    /**
     * @param ApiEvent $event
     */
    private function handleApi(ApiEvent $event)
    {
        $event->setCode($this->getJavascriptTagRenderer()->render($this->getApiRenderer()->render(
            $event->getCallbacks(),
            $event->getRequirements(),
            $event->getSources(),
            $event->getLibraries()
        )));
    }
}
