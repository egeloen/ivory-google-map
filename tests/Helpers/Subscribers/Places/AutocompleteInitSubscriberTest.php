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
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteInitSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractTestCase;

/**
 * Autocomplete init subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteInitSubscriberTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteInitSubscriber */
    private $autocompleteInitSubscriber;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocompleteInitSubscriber = new AutocompleteInitSubscriber();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocompleteInitSubscriber);
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteInitSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_INIT, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_INIT]);
    }

    public function testOnAutocomplete()
    {
        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getDispatcher')
            ->will($this->returnValue($eventDispatcher = $this->createSymfonyEventDispatcherMock()));

        $eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->identicalTo(PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER),
                $this->identicalTo($placesAutocompleteEvent)
            );

        $this->autocompleteInitSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
