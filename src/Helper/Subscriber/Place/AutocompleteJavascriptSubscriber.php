<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;
use Ivory\GoogleMap\Place\Autocomplete;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteJavascriptSubscriber extends AbstractDelegateSubscriber
{
    /**
     * @var AutocompleteRenderer
     */
    private $autocompleteRenderer;

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
     * @param AutocompleteRenderer  $autocompleteRenderer
     * @param CallbackRenderer      $callbackRenderer
     * @param JavascriptTagRenderer $javascriptTagRenderer
     */
    public function __construct(
        Formatter $formatter,
        AutocompleteRenderer $autocompleteRenderer,
        CallbackRenderer $callbackRenderer,
        JavascriptTagRenderer $javascriptTagRenderer
    ) {
        parent::__construct($formatter);

        $this->setAutocompleteRenderer($autocompleteRenderer);
        $this->setCallbackRenderer($callbackRenderer);
        $this->setJavascriptTagRenderer($javascriptTagRenderer);
    }

    /**
     * @return AutocompleteRenderer
     */
    public function getAutocompleteRenderer()
    {
        return $this->autocompleteRenderer;
    }

    /**
     * @param AutocompleteRenderer $autocompleteRenderer
     */
    public function setAutocompleteRenderer(AutocompleteRenderer $autocompleteRenderer)
    {
        $this->autocompleteRenderer = $autocompleteRenderer;
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
        } elseif ($event instanceof PlaceAutocompleteEvent) {
            $this->handleAutocomplete($event);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents()
    {
        return [
            ApiEvents::JAVASCRIPT_AUTOCOMPLETE  => [],
            PlaceAutocompleteEvents::JAVASCRIPT => [
                PlaceAutocompleteEvents::JAVASCRIPT_INIT,
                PlaceAutocompleteEvents::JAVASCRIPT_BASE,
                PlaceAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE,
                PlaceAutocompleteEvents::JAVASCRIPT_EVENT,
            ],
        ];
    }

    /**
     * @param ApiEvent $event
     */
    private function handleApi(ApiEvent $event)
    {
        foreach ($event->getObjects(Autocomplete::class) as $autocomplete) {
            $event->addLibraries(array_unique(array_merge($autocomplete->getLibraries(), ['places'])));
            $event->addCallback($autocomplete, $this->renderCallback($autocomplete));
            $event->addRequirement($autocomplete, $this->autocompleteRenderer->renderRequirement());
        }
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    private function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $formatter = $this->getFormatter();

        $event->setCode($this->javascriptTagRenderer->render($formatter->renderClosure(
            $event->getCode(),
            [],
            $this->renderCallback($event->getAutocomplete())
        )));
    }

    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    private function renderCallback(Autocomplete $autocomplete)
    {
        return $this->callbackRenderer->render($autocomplete->getVariable());
    }
}
