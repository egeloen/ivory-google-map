<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\EncodedPolylines;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Encoded polyline aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\EncodedPolylineAggregator */
    private $encodedPolylineAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineAggregator = new EncodedPolylineAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodedPolylineAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $encodedPolylines = array(), array $base = array())
    {
        $this->assertEquals(
            $expected,
            $this->encodedPolylineAggregator->aggregate($this->createMapMock($encodedPolylines), $base)
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $encodedPolyline1 = $this->createEncodedPolylineMock();
        $encodedPolyline2 = $this->createEncodedPolylineMock();

        $simpleEncodedPolylines = array($encodedPolyline1, $encodedPolyline2);
        $fullEncodedPolylines = array($encodedPolyline1, $encodedPolyline2, $encodedPolyline1);

        return array(
            array(array()),
            array($simpleEncodedPolylines, $simpleEncodedPolylines),
            array($simpleEncodedPolylines, $fullEncodedPolylines),
            array($simpleEncodedPolylines, $fullEncodedPolylines),
            array($simpleEncodedPolylines, $fullEncodedPolylines, array($encodedPolyline1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $encodedPolylines The encoded polylines.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $encodedPolylines = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($encodedPolylines)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $encodedPolylines The encoded polylines.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $encodedPolylines = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getEncodedPolylines')
            ->will($this->returnValue($encodedPolylines));

        return $overlays;
    }
}
