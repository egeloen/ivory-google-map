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
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteContainerSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete container subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteContainerSubscriber */
    private $containerSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Places\AutocompleteContainerRenderer */
    private $containerRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->containerSubscriber = new AutocompleteContainerSubscriber(
            $this->formatter,
            $this->containerRenderer = $this->createAutocompleteContainerRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->containerRenderer);
        unset($this->containerSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->containerSubscriber);
    }

    public function testDefaultState()
    {
        $this->containerSubscriber = new AutocompleteContainerSubscriber();

        $this->assertFormatterInstance($this->containerSubscriber->getFormatter());
        $this->assertAutocompleteContainerRendererInstance($this->containerSubscriber->getContainerRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->containerSubscriber->getFormatter());
        $this->assertSame($this->containerRenderer, $this->containerSubscriber->getContainerRenderer());
    }

    public function testSetContainerRenderer()
    {
        $this->containerSubscriber->setContainerRenderer(
            $containerRenderer = $this->createAutocompleteContainerRendererMock()
        );

        $this->assertSame($containerRenderer, $this->containerSubscriber->getContainerRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteContainerSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER]);
    }

    public function testOnAutocomplete()
    {
        $this->containerRenderer
            ->expects($this->once())
            ->method('render')
            ->will($this->returnValue($render = 'render'));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($autocomplete = $this->createAutocompleteMock()),
                $this->identicalTo($render)
            )
            ->will($this->returnValue($code = 'code'));

        $autocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $autocompleteEvent
            ->expects($this->any())
            ->method('getAutocomplete')
            ->will($this->returnValue($autocomplete));

        $autocompleteEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->containerSubscriber->onAutocomplete($autocompleteEvent);
    }
}
