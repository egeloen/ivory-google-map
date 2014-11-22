<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Rectangles;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Rectangle aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator */
    private $rectangleAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangleAggregator = new RectangleAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangleAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $rectangles = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->rectangleAggregator->aggregate($this->createMapMock($rectangles), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $rectangle1 = $this->createRectangleMock();
        $rectangle2 = $this->createRectangleMock();

        $simpleRectangles = array($rectangle1, $rectangle2);
        $fullRectangles = array($rectangle1, $rectangle2, $rectangle1);

        return array(
            array(array()),
            array($simpleRectangles, $simpleRectangles),
            array($simpleRectangles, $fullRectangles),
            array($simpleRectangles, $fullRectangles),
            array($simpleRectangles, $fullRectangles, array($rectangle1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $rectangles The rectangles.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $rectangles = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($rectangles)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $rectangles The rectangles.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $rectangles = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getRectangles')
            ->will($this->returnValue($rectangles));

        return $overlays;
    }
}
