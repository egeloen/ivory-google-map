<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer;

/**
 * Api javascript subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiJavascriptSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer */
    private $loaderRenderer;

    /**
     * Creates an api javascript subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null    $formatter      The formatter.
     * @param \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer|null $loaderRenderer The loader renderer.
     */
    public function __construct(Formatter $formatter = null, LoaderRenderer $loaderRenderer = null)
    {
        parent::__construct($formatter);

        $this->setLoaderRenderer($loaderRenderer ?: new LoaderRenderer());
    }

    /**
     * Gets the loader renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer The loader renderer.
     */
    public function getLoaderRenderer()
    {
        return $this->loaderRenderer;
    }

    /**
     * Sets the loader renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer $loaderRenderer The loader renderer.
     */
    public function setLoaderRenderer(LoaderRenderer $loaderRenderer)
    {
        $this->loaderRenderer = $loaderRenderer;
    }

    /**
     * Renders the javascript api.
     *
     * @param \Ivory\GoogleMap\Helpers\ApiEvent $apiEvent The api event.
     */
    public function onApi(ApiEvent $apiEvent)
    {
        $apiEvent->getDispatcher()->dispatch(ApiEvents::JAVASCRIPT_MAP, $apiEvent);
        $apiEvent->getDispatcher()->dispatch(ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE, $apiEvent);

        $token = str_replace('.', '', uniqid(null, true));

        $loaderCallback = $this->getFormatter()->formatCallback('ivory_google_map_loader_'.$token);
        $apiCallback = $firstApiCallback = $lastApiCallback = $this->getFormatter()->formatCallback(
            'ivory_google_map_api_'.$token
        );

        $sources = null;
        foreach ($apiEvent->getSources() as $index => $source) {
            $sources .= $this->getFormatter()->formatFunction(
                $this->getFormatter()->formatSource(
                    $source,
                    $lastApiCallback = $apiCallback.($index + 2)
                ),
                array(),
                $apiCallback.($index + 1)
            );

            if ($firstApiCallback === $apiCallback) {
                $firstApiCallback = $apiCallback.($index + 1);
            }
        }

        $callbackCalls = null;
        foreach ($apiEvent->getCallbacks() as $callback) {
            $callbackCalls .= $this->getFormatter()->formatFunctionCall($callback);
        }

        $callbacks = $this->getFormatter()->formatFunction($callbackCalls, array(), $lastApiCallback);

        $loader = $this->getFormatter()->formatFunction(
            $this->getFormatter()->formatCode($this->loaderRenderer->render(
                $apiEvent->getLanguage(),
                $apiEvent->getLibraries(),
                $firstApiCallback
            )),
            array(),
            $loaderCallback
        );

        $apiEvent->addCode($this->getFormatter()->formatJavascript($loader.$sources.$callbacks));
        $apiEvent->addCode($this->getFormatter()->formatSource($this->loaderRenderer->renderSource($loaderCallback)));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(ApiEvents::JAVASCRIPT => 'onApi');
    }
}
