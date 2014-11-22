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
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBoundSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete bound subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteBoundSubscriber */
    private $boundSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $boundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->boundSubscriber = new AutocompleteBoundSubscriber(
            $this->formatter,
            $this->boundAggregator = $this->createAutocompleteBoundAggregatorMock(),
            $this->boundRenderer = $this->createBoundRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->boundRenderer);
        unset($this->boundAggregator);
        unset($this->boundSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->boundSubscriber);
    }

    public function testDefaultState()
    {
        $this->boundSubscriber = new AutocompleteBoundSubscriber();

        $this->assertFormatterInstance($this->boundSubscriber->getFormatter());
        $this->assertAutocompleteBoundAggregatorInstance($this->boundSubscriber->getBoundAggregator());
        $this->assertBoundRendererInstance($this->boundSubscriber->getBoundRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->boundSubscriber->getFormatter());
        $this->assertSame($this->boundAggregator, $this->boundSubscriber->getBoundAggregator());
        $this->assertSame($this->boundRenderer, $this->boundSubscriber->getBoundRenderer());
    }

    public function testSetBoundAggregator()
    {
        $this->boundSubscriber->setBoundAggregator($boundAggregator = $this->createAutocompleteBoundAggregatorMock());

        $this->assertSame($boundAggregator, $this->boundSubscriber->getBoundAggregator());
    }

    public function testSetBoundRenderer()
    {
        $this->boundSubscriber->setBoundRenderer($boundRenderer = $this->createBoundRendererMock());

        $this->assertSame($boundRenderer, $this->boundSubscriber->getBoundRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteBoundSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND]);
    }

    public function testOnAutocomplete()
    {
        $this->boundAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue(array($bound = $this->createBoundMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($autocomplete),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.bounds'),
                $this->identicalTo($bound)
            )
            ->will($this->returnValue($code = 'code'));

        $this->boundRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($bound))
            ->will($this->returnValue($render));

        $placesAutocompleteEvent = $this->createPlacesAutocompleteEventMock();
        $placesAutocompleteEvent
            ->expects($this->any())
            ->method('getAutocomplete')
            ->will($this->returnValue($autocomplete));

        $placesAutocompleteEvent
            ->expects($this->once())
            ->method('addCode')
            ->with($this->identicalTo($code));

        $this->boundSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
