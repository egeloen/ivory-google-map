<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Polylines;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Polyline aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator */
    private $polylineAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineAggregator = new PolylineAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polylineAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $polylines = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->polylineAggregator->aggregate($this->createMapMock($polylines), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $polyline1 = $this->createPolylineMock();
        $polyline2 = $this->createPolylineMock();

        $simplePolylines = array($polyline1, $polyline2);
        $fullPolylines = array($polyline1, $polyline2, $polyline1);

        return array(
            array(array()),
            array($simplePolylines, $simplePolylines),
            array($simplePolylines, $fullPolylines),
            array($simplePolylines, $fullPolylines),
            array($simplePolylines, $fullPolylines, array($polyline1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $polylines The polylines.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $polylines = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($polylines)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $polylines The polylines.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $polylines = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getPolylines')
            ->will($this->returnValue($polylines));

        return $overlays;
    }
}
