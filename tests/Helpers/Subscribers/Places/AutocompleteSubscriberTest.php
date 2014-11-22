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
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteSubscriber */
    private $autocompleteSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $autocompleteRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->autocompleteSubscriber = new AutocompleteSubscriber(
            $this->formatter,
            $this->autocompleteRenderer = $this->createAutocompleteRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->autocompleteRenderer);
        unset($this->autocompleteSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->autocompleteSubscriber);
    }

    public function testDefaultState()
    {
        $this->autocompleteSubscriber = new AutocompleteSubscriber();

        $this->assertFormatterInstance($this->autocompleteSubscriber->getFormatter());
        $this->assertAutocompleteRendererInstance($this->autocompleteSubscriber->getAutocompleteRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->autocompleteSubscriber->getFormatter());
        $this->assertSame($this->autocompleteRenderer, $this->autocompleteSubscriber->getAutocompleteRenderer());
    }

    public function testSetAutocompleteRenderer()
    {
        $this->autocompleteSubscriber->setAutocompleteRenderer(
            $autocompleteRenderer = $this->createAutocompleteRendererMock()
        );

        $this->assertSame($autocompleteRenderer, $this->autocompleteSubscriber->getAutocompleteRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE]);
    }

    public function testOnAutocomplete()
    {
        $this->autocompleteRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($autocomplete),
                $this->identicalTo($render),
                $this->identicalTo('autocomplete'),
                $this->identicalTo($autocomplete),
                $this->identicalTo(false)
            )
            ->will($this->returnValue($code = 'code'));

        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getAutocomplete')
            ->will($this->returnValue($autocomplete));

        $placesAutocompleteEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->autocompleteSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
