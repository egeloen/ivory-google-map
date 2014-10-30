<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Polygons;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Polygon aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator */
    private $polygonAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygonAggregator = new PolygonAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygonAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $polygons = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->polygonAggregator->aggregate($this->createMapMock($polygons), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $polygon1 = $this->createPolygonMock();
        $polygon2 = $this->createPolygonMock();

        $simplePolygons = array($polygon1, $polygon2);
        $fullPolygons = array($polygon1, $polygon2, $polygon1);

        return array(
            array(array()),
            array($simplePolygons, $simplePolygons),
            array($simplePolygons, $fullPolygons),
            array($simplePolygons, $fullPolygons),
            array($simplePolygons, $fullPolygons, array($polygon1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $polygons The polygons.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $polygons = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($polygons)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $polygons The polygons.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $polygons = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getPolygons')
            ->will($this->returnValue($polygons));

        return $overlays;
    }
}
