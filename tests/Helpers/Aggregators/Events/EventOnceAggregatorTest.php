<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\EventOnces;

use Ivory\GoogleMap\Helpers\Aggregators\Events\EventOnceAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * EventOnce aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventOnceAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\EventOnces\EventOnceAggregator */
    private $eventOnceAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventOnceAggregator = new EventOnceAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventOnceAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $eventOnces = array(), array $events = array())
    {
        $this->assertEquals(
            $expected,
            $this->eventOnceAggregator->aggregate($this->createMapMock($eventOnces), $events)
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $eventOnce1 = $this->createEventMock();
        $eventOnce2 = $this->createEventMock();

        $simpleEventOnces = array($eventOnce1, $eventOnce2);
        $fullEventOnces = array($eventOnce1, $eventOnce2, $eventOnce1);

        return array(
            array(array()),
            array($simpleEventOnces, $simpleEventOnces),
            array($simpleEventOnces, $fullEventOnces),
            array($simpleEventOnces, $fullEventOnces),
            array($simpleEventOnces, $fullEventOnces, array($eventOnce1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $eventOnces The event onces.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $eventOnces = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($overlays = $this->createEventsMock($eventOnces)));

        return $map;
    }

    /**
     * Creates an events mock.
     *
     * @param array $eventOnces The event onces.
     *
     * @return \Ivory\GoogleMap\Events\Events|\PHPUnit_Framework_MockObject_MockObject The events mock.
     */
    protected function createEventsMock(array $eventOnces = array())
    {
        $events = parent::createEventsMock();
        $events
            ->expects($this->any())
            ->method('getEventsOnce')
            ->will($this->returnValue($eventOnces));

        return $events;
    }
}
