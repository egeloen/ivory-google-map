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

use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Dom event aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventAggregator */
    private $domEventAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEventAggregator = new DomEventAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->domEventAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $domEvents = array(), array $events = array())
    {
        $this->assertEquals($expected, $this->domEventAggregator->aggregate($this->createMapMock($domEvents), $events));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $domEvent1 = $this->createDomEventMock();
        $domEvent2 = $this->createDomEventMock();

        $simpleDomEvents = array($domEvent1, $domEvent2);
        $fullDomEvents = array($domEvent1, $domEvent2, $domEvent1);

        return array(
            array(array()),
            array($simpleDomEvents, $simpleDomEvents),
            array($simpleDomEvents, $fullDomEvents),
            array($simpleDomEvents, $fullDomEvents),
            array($simpleDomEvents, $fullDomEvents, array($domEvent1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $domEvents The dom events.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $domEvents = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($overlays = $this->createEventsMock($domEvents)));

        return $map;
    }

    /**
     * Creates an events mock.
     *
     * @param array $domEvents The dom events.
     *
     * @return \Ivory\GoogleMap\Events\Events|\PHPUnit_Framework_MockObject_MockObject The events mock.
     */
    protected function createEventsMock(array $domEvents = array())
    {
        $events = parent::createEventsMock();
        $events
            ->expects($this->any())
            ->method('getDomEvents')
            ->will($this->returnValue($domEvents));

        return $events;
    }
}
