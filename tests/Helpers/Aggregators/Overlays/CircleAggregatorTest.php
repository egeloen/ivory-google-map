<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Circles;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Circle aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator */
    private $circleAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circleAggregator = new CircleAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circleAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $circles = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->circleAggregator->aggregate($this->createMapMock($circles), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $circle1 = $this->createCircleMock();
        $circle2 = $this->createCircleMock();

        $simpleCircles = array($circle1, $circle2);
        $fullCircles = array($circle1, $circle2, $circle1);

        return array(
            array(array()),
            array($simpleCircles, $simpleCircles),
            array($simpleCircles, $fullCircles),
            array($simpleCircles, $fullCircles),
            array($simpleCircles, $fullCircles, array($circle1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $circles The circles.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $circles = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($circles)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $circles The circles.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $circles = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getCircles')
            ->will($this->returnValue($circles));

        return $overlays;
    }
}
