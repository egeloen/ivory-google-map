<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers;

use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\Subscribers\ApiJavascriptSubscriber;

/**
 * Api javascript subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiJavascriptSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\ApiJavascriptSubscriber */
    private $apiJavascriptSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\LoaderRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $loaderRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->apiJavascriptSubscriber = new ApiJavascriptSubscriber(
            $this->formatter,
            $this->loaderRenderer = $this->createLoaderRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->loaderRenderer);
        unset($this->apiJavascriptSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->apiJavascriptSubscriber);
    }

    public function testDefaultState()
    {
        $this->apiJavascriptSubscriber = new ApiJavascriptSubscriber();

        $this->assertFormatterInstance($this->apiJavascriptSubscriber->getFormatter());
        $this->assertLoaderRendererInstance($this->apiJavascriptSubscriber->getLoaderRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->apiJavascriptSubscriber->getFormatter());
        $this->assertSame($this->loaderRenderer, $this->apiJavascriptSubscriber->getLoaderRenderer());
    }

    public function testSetLoaderRenderer()
    {
        $this->apiJavascriptSubscriber->setLoaderRenderer($loaderRenderer = $this->createLoaderRendererMock());

        $this->assertSame($loaderRenderer, $this->apiJavascriptSubscriber->getLoaderRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = ApiJavascriptSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT]);
    }

    public function testOnApi()
    {
        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(ApiEvents::JAVASCRIPT_MAP, $apiEvent),
                array(ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE, $apiEvent),
            )));

        $apiEvent
            ->expects($this->any())
            ->method('getSources')
            ->will($this->returnValue(array($source = 'source')));

        $apiEvent
            ->expects($this->any())
            ->method('getCallbacks')
            ->will($this->returnValue(array($callback = 'callback')));

        $apiEvent
            ->expects($this->any())
            ->method('getLibraries')
            ->will($this->returnValue($libraries = array('geometry')));

        $apiEvent
            ->expects($this->any())
            ->method('getLanguage')
            ->will($this->returnValue($language = 'en'));

        $loaderCallback = 'loader_callback';
        $apiCallback = 'api_callback';

        $this->formatter
            ->expects($this->exactly(2))
            ->method('formatCallback')
            ->will($this->returnCallback(function ($name) use ($loaderCallback, $apiCallback) {
                if (strpos($name, 'ivory_google_map_loader') === 0) {
                    return $loaderCallback;
                }

                if (strpos($name, 'ivory_google_map_api') === 0) {
                    return $apiCallback;
                }
            }));

        $this->loaderRenderer
            ->expects($this->once())
            ->method('renderSource')
            ->with($this->identicalTo($loaderCallback))
            ->will($this->returnValue($renderSource = 'render_source'));

        $this->formatter
            ->expects($this->any(2))
            ->method('formatSource')
            ->will($this->returnValueMap(array(
                array($source, $apiCallback.'2', $apiSource = 'api_source'),
                array($renderSource, null, $javascriptSource = 'javascript_source'),
            )));

        $this->formatter
            ->expects($this->any(1))
            ->method('formatFunctionCall')
            ->will($this->returnValueMap(array(
                array($callback, array(), true, true, $callbackFunctionCall = 'callback_function_call'),
            )));

        $this->loaderRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($language),
                $this->identicalTo($libraries),
                $this->identicalTo($apiCallback.'1')
            )
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->any(1))
            ->method('formatCode')
            ->will($this->returnValueMap(array(
                array($render, true, true, $loader = 'loader'),
            )));

        $this->formatter
            ->expects($this->any(3))
            ->method('formatFunction')
            ->will($this->returnValueMap(array(
                array($apiSource, array(), $apiCallback.'1', true, true, true, $sourceFunction = 'api_function'),
                array(
                    $callbackFunctionCall,
                    array(),
                    $apiCallback.'2',
                    true,
                    true,
                    true,
                    $callbackFunction = 'callback_function',
                ),
                array(
                    $loader,
                    array(),
                    $loaderCallback,
                    true,
                    true,
                    true,
                    $loaderFunction = 'loader_function',
                ),
            )));

        $this->formatter
            ->expects($this->any(1))
            ->method('formatJavascript')
            ->will($this->returnValueMap(array(
                array($loaderFunction.$sourceFunction.$callbackFunction, array(), $javascript = 'javascript'),
            )));

        $apiEvent
            ->expects($this->exactly(2))
            ->method('addCode')
            ->withConsecutive(
                array($this->identicalTo($javascript)),
                array($this->identicalTo($javascriptSource))
            );

        $this->apiJavascriptSubscriber->onApi($apiEvent);
    }
}
