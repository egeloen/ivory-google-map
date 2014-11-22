<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Markers;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Marker aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerAggregator = new MarkerAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $markers = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->markerAggregator->aggregate($this->createMapMock($markers), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $marker1 = $this->createMarkerMock();
        $marker2 = $this->createMarkerMock();

        $simpleMarkers = array($marker1, $marker2);
        $fullMarkers = array($marker1, $marker2, $marker1);

        return array(
            array(array()),
            array($simpleMarkers, $simpleMarkers),
            array($simpleMarkers, $fullMarkers),
            array($simpleMarkers, $fullMarkers),
            array($simpleMarkers, $fullMarkers, array($marker1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $markers The markers.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $markers = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($markers)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $markers The markers.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $markers = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getMarkers')
            ->will($this->returnValue($markers));

        return $overlays;
    }
}
