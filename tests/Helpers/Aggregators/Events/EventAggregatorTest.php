<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Events;

use Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Event aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\EventAggregator */
    private $eventAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventAggregator = new EventAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $events = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->eventAggregator->aggregate($this->createMapMock($events), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $event1 = $this->createEventMock();
        $event2 = $this->createEventMock();

        $simpleEvents = array($event1, $event2);
        $fullEvents = array($event1, $event2, $event1);

        return array(
            array(array()),
            array($simpleEvents, $simpleEvents),
            array($simpleEvents, $fullEvents),
            array($simpleEvents, $fullEvents),
            array($simpleEvents, $fullEvents, array($event1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $events The events.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $events = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($overlays = $this->createEventsMock($events)));

        return $map;
    }

    /**
     * Creates an events mock.
     *
     * @param array $events The events.
     *
     * @return \Ivory\GoogleMap\Events\Events|\PHPUnit_Framework_MockObject_MockObject The events mock.
     */
    protected function createEventsMock(array $events = array())
    {
        $mock = parent::createEventsMock();
        $mock
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($events));

        return $mock;
    }
}
