<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Base;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator;
use Ivory\GoogleMap\Overlays\Icon;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Point aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\PointAggregator */
    private $pointAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointAggregator = new PointAggregator($this->markerAggregator = $this->createMarkerAggregatorMock());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerAggregator);
        unset($this->pointAggregator);
    }

    public function testDefaultState()
    {
        $this->pointAggregator = new PointAggregator();

        $this->assertMarkerAggregatorInstance($this->pointAggregator->getMarkerAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerAggregator, $this->pointAggregator->getMarkerAggregator());
    }

    public function testSetMarkerAggregator()
    {
        $this->pointAggregator->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->pointAggregator->getMarkerAggregator());
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregateMarkers(array $expected, array $markers = array(), array $points = array())
    {
        $map = $this->createMapMock();

        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->pointAggregator->aggregateMarkers($map, $points));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate($expected, $markers = array(), array $points = array())
    {
        $map = $this->createMapMock();

        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->pointAggregator->aggregate($map, $points));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $marker1 = $this->createMarkerMock();

        $marker2 = $this->createMarkerMock($this->createIconMock(
            $point1 = $this->createPointMock(),
            $point2 = $this->createPointMock()
        ));

        $marker3 = $this->createMarkerMock(null, $this->createIconMock(
            $point3 = $this->createPointMock(),
            $point4 = $this->createPointMock()
        ));

        $marker4 = $this->createMarkerMock(
            $this->createIconMock(
                $point5 = $this->createPointMock(),
                $point3
            ),
            $this->createIconMock(
                $point3,
                $point2
            )
        );

        $simpleMarkers = array($marker1, $marker2, $marker3);
        $fullMarkers = array($marker1, $marker2, $marker3, $marker4);

        $simplePoints = array($point1, $point2, $point3, $point4);
        $fullPoints = array($point1, $point2, $point3, $point4, $point5);

        return array(
            array(array()),
            array($simplePoints, $simpleMarkers),
            array($fullPoints, $fullMarkers),
            array($fullPoints, $fullMarkers, $simplePoints),
        );
    }

    /**
     * Creates an icon mock.
     *
     * @param \Ivory\GoogleMap\Base\Point|null $anchor The anchor.
     * @param \Ivory\GoogleMap\Base\Point|null $origin The origin.
     *
     * @return \Ivory\GoogleMap\Overlays\Icon|\PHPUnit_Framework_MockObject_MockObject The icon mock.
     */
    protected function createIconMock(Point $anchor = null, Point $origin = null)
    {
        $icon = parent::createIconMock();

        if ($anchor !== null) {
            $icon
                ->expects($this->any())
                ->method('hasAnchor')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getAnchor')
                ->will($this->returnValue($anchor));
        }

        if ($origin !== null) {
            $icon
                ->expects($this->any())
                ->method('hasOrigin')
                ->will($this->returnValue(true));

            $icon
                ->expects($this->any())
                ->method('getOrigin')
                ->will($this->returnValue($origin));
        }

        return $icon;
    }

    /**
     * Creates a marker mock.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon|null $icon   The icon.
     * @param \Ivory\GoogleMap\Overlays\Icon|null $shadow The shadow.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(Icon $icon = null, Icon $shadow = null)
    {
        $marker = parent::createMarkerMock();

        if ($icon !== null) {
            $marker
                ->expects($this->any())
                ->method('hasIcon')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getIcon')
                ->will($this->returnValue($icon));
        }

        if ($shadow !== null) {
            $marker
                ->expects($this->any())
                ->method('hasShadow')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getShadow')
                ->will($this->returnValue($shadow));
        }

        return $marker;
    }
}
