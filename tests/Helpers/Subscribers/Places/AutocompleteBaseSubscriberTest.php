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

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBaseSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Autocomplete base subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBaseSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBaseSubscriber */
    private $autocompleteBaseSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteBaseSubscriber = new AutocompleteBaseSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocompleteBaseSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteBaseSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_BASE, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_BASE]);
    }

    public function testOnAutocomplete()
    {
        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->will($this->returnValueMap(array(
                array(PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE, $placesAutocompleteEvent),
                array(PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND, $placesAutocompleteEvent),
            )));

        $this->autocompleteBaseSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
