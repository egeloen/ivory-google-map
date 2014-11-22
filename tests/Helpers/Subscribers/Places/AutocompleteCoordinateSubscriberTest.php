<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Subscribers\Base;

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteCoordinateSubscriber;
use Ivory\Tests\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriberTest;

/**
 * Autocomplete coordinate subscriber test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateSubscriberTest extends AbstractFormatterSubscriberTest
{
    /** @var \Ivory\GoogleMap\Helpers\Subscribers\Places\AutocompleteCoordinateSubscriber */
    private $coordinateSubscriber;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\CoordinateAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $coordinateRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->coordinateSubscriber = new AutocompleteCoordinateSubscriber(
            $this->formatter,
            $this->coordinateAggregator = $this->createAutocompleteCoordinateAggregatorMock(),
            $this->coordinateRenderer = $this->createCoordinateRendererMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        unset($this->coordinateRenderer);
        unset($this->coordinateAggregator);
        unset($this->coordinateSubscriber);
    }

    public function testInheritance()
    {
        $this->assertFormatterSubscriberInstance($this->coordinateSubscriber);
    }

    public function testDefaultState()
    {
        $this->coordinateSubscriber = new AutocompleteCoordinateSubscriber();

        $this->assertFormatterInstance($this->coordinateSubscriber->getFormatter());
        $this->assertAutocompleteCoordinateAggregatorInstance($this->coordinateSubscriber->getCoordinateAggregator());
        $this->assertCoordinateRendererInstance($this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testInitialState()
    {
        $this->assertSame($this->formatter, $this->coordinateSubscriber->getFormatter());
        $this->assertSame($this->coordinateAggregator, $this->coordinateSubscriber->getCoordinateAggregator());
        $this->assertSame($this->coordinateRenderer, $this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testSetCoordinateAggregator()
    {
        $this->coordinateSubscriber->setCoordinateAggregator(
            $coordinateAggregator = $this->createAutocompleteCoordinateAggregatorMock()
        );

        $this->assertSame($coordinateAggregator, $this->coordinateSubscriber->getCoordinateAggregator());
    }

    public function testSetCoordinateRenderer()
    {
        $this->coordinateSubscriber->setCoordinateRenderer(
            $coordinateRenderer = $this->createCoordinateRendererMock()
        );

        $this->assertSame($coordinateRenderer, $this->coordinateSubscriber->getCoordinateRenderer());
    }

    public function testSubscribedEvents()
    {
        $subscribedEvents = AutocompleteCoordinateSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE, $subscribedEvents);
        $this->assertSame('onAutocomplete', $subscribedEvents[PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE]);
    }

    public function testOnMap()
    {
        $this->coordinateAggregator
            ->expects($this->once())
            ->method('aggregate')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue(array($coordinate = $this->createCoordinateMock())));

        $this->formatter
            ->expects($this->once())
            ->method('formatContainerAssignment')
            ->with(
                $this->identicalTo($autocomplete),
                $this->identicalTo($render = 'render'),
                $this->identicalTo('base.coordinates'),
                $this->identicalTo($coordinate)
            )
            ->will($this->returnValue($code = 'code'));

        $this->coordinateRenderer
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($coordinate))
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

        $this->coordinateSubscriber->onAutocomplete($placesAutocompleteEvent);
    }
}
