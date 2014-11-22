<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Places;

use Ivory\GoogleMap\Helpers\ApiEvent;
use Ivory\GoogleMap\Helpers\ApiEvents;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteJavascriptSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete javascript subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteJavascriptSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteJavascriptSubscriber */
    private $autocompleteJavascriptSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->autocompleteJavascriptSubscriber = new AutocompleteJavascriptSubscriber($this->formatter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->autocompleteJavascriptSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->autocompleteJavascriptSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteJavascriptSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE, $subscribedEvents);
        $this->assertSame('onApi', $subscribedEvents[ApiEvents::JAVASCRIPT_PLACES_AUTOCOMPLETE]);

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT]);
    }

    public function testOnApi()
    {
        $apiEvent = $this->createApiEventMock();
        $apiEvent
            ->expects($this->once())
            ->method('getItems')
            ->with($this->identicalTo(ApiEvent::PLACES_AUTOCOMPLETE))
            ->will($this->returnValue(array($autocomplete = $this->createAutocompleteMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatAssetCallback')
            ->with($this->identicalTo($autocomplete))
            ->will($this->returnValue($callback = 'callback'));

        $apiEvent
            ->expects($this->once())
            ->method('addCallback')
            ->with($this->identicalTo($callback));

        $apiEvent
            ->expects($this->once())
            ->method('addLibrary')
            ->with($this->identicalTo('places'));

        $this->autocompleteJavascriptSubscriber->onApi($apiEvent);
    }

    public function testOnAutocomplete()
    {
        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(3))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(PlacesAutocompleteEvents::JAVASCRIPT_INIT, $placesAutocompleteEvent),
                array(PlacesAutocompleteEvents::JAVASCRIPT_BASE, $placesAutocompleteEvent),
                array(PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE, $placesAutocompleteEvent),
            )));

        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getCode')
            ->will($this->returnValue($code = 'code'));

        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getAutocomplete')
            ->will($this->returnValue($autocomplete = $this->createAutocompleteMock()));

        $this->formatter
            ->expects($this->once())
            ->method('formatAssetCallback')
            ->with($this->identicalTo($autocomplete))
            ->will($this->returnValue($callback = 'callback'));

        $this->formatter
            ->expects($this->once())
            ->method('formatFunction')
            ->with(
                $this->identicalTo($code),
                $this->identicalTo(array()),
                $this->identicalTo($callback)
            )
            ->will($this->returnValue($function = 'function'));

        $this->formatter
            ->expects($this->once())
            ->method('formatJavascript')
            ->with($this->identicalTo($function))
            ->will($this->returnValue($javascript = 'javascript'));

        $placesAutocompleteEvent
            ->expects($this->once())
            ->method('setCode')
            ->will($this->returnValue($javascript));

        $this->autocompleteJavascriptSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
