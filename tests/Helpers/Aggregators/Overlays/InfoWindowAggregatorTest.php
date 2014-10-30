<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\InfoWindows;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Info window aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoWindowAggregator = new InfoWindowAggregator(
            $this->markerAggregator = $this->createMarkerAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerAggregator);
        unset($this->infoWindowAggregator);
    }

    public function testDefaultState()
    {
        $this->infoWindowAggregator = new InfoWindowAggregator();

        $this->assertMarkerAggregatorInstance($this->infoWindowAggregator->getMarkerAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerAggregator, $this->infoWindowAggregator->getMarkerAggregator());
    }

    public function testSetMarkerAggregator()
    {
        $this->infoWindowAggregator->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->infoWindowAggregator->getMarkerAggregator());
    }

    /**
     * @dataProvider aggregateInfoWindowsProvider
     */
    public function testAggregateInfoWindows(array $expected, array $infoWindows = array(), array $base = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($infoWindows)))
            ->will($this->returnValue(array()));

        $this->assertEquals($expected, $this->infoWindowAggregator->aggregateInfoWindows($map, $base));
    }

    /**
     * @dataProvider aggregateMarkersProvider
     */
    public function testAggregateMarkers(array $expected, array $markers = array(), array $infoWindows = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->infoWindowAggregator->aggregateMarkers($map, $infoWindows));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(
        array $expected,
        array $infoWindows = array(),
        array $markers = array(),
        array $base = array()
    ) {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock($infoWindows)))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->infoWindowAggregator->aggregate($map, $base));
    }

    /**
     * Gets the info windows aggregate provider.
     *
     * @return array The info windows aggregate provider.
     */
    public function aggregateInfoWindowsProvider()
    {
        $infoWindow1 = $this->createInfoWindowMock();
        $infoWindow2 = $this->createInfoWindowMock();

        $simpleInfoWindows = array($infoWindow1, $infoWindow2);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow1);

        return array(
            array(array()),
            array($simpleInfoWindows, $simpleInfoWindows),
            array($simpleInfoWindows, $fullInfoWindows),
            array($simpleInfoWindows, $fullInfoWindows, $simpleInfoWindows),
        );
    }

    /**
     * Gets the aggregate markers provider.
     *
     * @return array The aggregate markers provider.
     */
    public function aggregateMarkersProvider()
    {
        $marker1 = $this->createMarkerMock();
        $marker2 = $this->createMarkerMock($infoWindow1 = $this->createInfoWindowMock());
        $marker3 = $this->createMarkerMock($infoWindow2 = $this->createInfoWindowMock());
        $marker4 = $this->createMarkerMock($infoWindow1);

        $simpleMarkers = array($marker1, $marker2);
        $fullMarkers = array($marker1, $marker2, $marker3, $marker4);

        $simpleInfoWindows = array($infoWindow1);
        $fullInfoWindows = array($infoWindow1, $infoWindow2);

        return array(
            array(array()),
            array($simpleInfoWindows, $simpleMarkers),
            array($fullInfoWindows, $fullMarkers),
            array($fullInfoWindows, $fullMarkers, $simpleInfoWindows),
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $infoWindow1 = $this->createInfoWindowMock();
        $infoWindow2 = $this->createInfoWindowMock();

        $marker1 = $this->createMarkerMock();
        $marker2 = $this->createMarkerMock($infoWindow3 = $this->createInfoWindowMock());
        $marker3 = $this->createMarkerMock($infoWindow4 = $this->createInfoWindowMock());
        $marker4 = $this->createMarkerMock($infoWindow3);

        $simpleOverlaysInfoWindows = array($infoWindow1, $infoWindow2);
        $fullOverlaysInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow1);

        $simpleMarkers = array($marker1, $marker2);
        $fullMarkers = array($marker1, $marker2, $marker3, $marker4);

        $simpleInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3);
        $fullInfoWindows = array($infoWindow1, $infoWindow2, $infoWindow3, $infoWindow4);

        return array(
            array(array()),
            array($simpleInfoWindows, $simpleOverlaysInfoWindows, $simpleMarkers),
            array($fullInfoWindows, $fullOverlaysInfoWindows, $fullMarkers),
            array($fullInfoWindows, $fullOverlaysInfoWindows, $fullMarkers, $simpleInfoWindows),
        );
    }

    protected function createMapMock(array $infoWindows = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($this->createOverlaysMock($infoWindows)));

        return $map;
    }

    /**
     * Creates a maker mock.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow|null $infoWindow The info window.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(InfoWindow $infoWindow = null)
    {
        $marker = parent::createMarkerMock();

        if ($infoWindow !== null) {
            $marker
                ->expects($this->any())
                ->method('hasInfoWindow')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getInfoWindow')
                ->will($this->returnValue($infoWindow));
        }

        return $marker;
    }

    protected function createOverlaysMock(array $infoWindows = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getInfoWindows')
            ->will($this->returnValue($infoWindows));

        return $overlays;
    }
}
