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

use Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Dom event aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Events\DomEventOnceAggregator */
    private $domEventOnceAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->domEventOnceAggregator = new DomEventOnceAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->domEventOnceAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $domEventOnces = array(), array $events = array())
    {
        $this->assertEquals(
            $expected,
            $this->domEventOnceAggregator->aggregate($this->createMapMock($domEventOnces), $events)
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $domEventOnce1 = $this->createDomEventMock();
        $domEventOnce2 = $this->createDomEventMock();

        $simpleDomEventOnces = array($domEventOnce1, $domEventOnce2);
        $fullDomEventOnces = array($domEventOnce1, $domEventOnce2, $domEventOnce1);

        return array(
            array(array()),
            array($simpleDomEventOnces, $simpleDomEventOnces),
            array($simpleDomEventOnces, $fullDomEventOnces),
            array($simpleDomEventOnces, $fullDomEventOnces),
            array($simpleDomEventOnces, $fullDomEventOnces, array($domEventOnce1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $domEventOnces The dom events once.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $domEventOnces = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getEvents')
            ->will($this->returnValue($overlays = $this->createEventsMock($domEventOnces)));

        return $map;
    }

    /**
     * Creates an events mock.
     *
     * @param array $domEventOnces The dom events once.
     *
     * @return \Ivory\GoogleMap\Events\Events|\PHPUnit_Framework_MockObject_MockObject The events mock.
     */
    protected function createEventsMock(array $domEventOnces = array())
    {
        $events = parent::createEventsMock();
        $events
            ->expects($this->any())
            ->method('getDomEventsOnce')
            ->will($this->returnValue($domEventOnces));

        return $events;
    }
}
