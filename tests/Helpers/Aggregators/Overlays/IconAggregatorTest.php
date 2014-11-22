<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\Icons;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator;
use Ivory\GoogleMap\Overlays\Icon;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Icon aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\IconAggregator */
    private $iconAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->iconAggregator = new IconAggregator($this->markerAggregator = $this->createMarkerAggregatorMock());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerAggregator);
        unset($this->iconAggregator);
    }

    public function testDefaultState()
    {
        $this->iconAggregator = new IconAggregator();

        $this->assertMarkerAggregatorInstance($this->iconAggregator->getMarkerAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerAggregator, $this->iconAggregator->getMarkerAggregator());
    }

    public function testSetMarkerAggregator()
    {
        $this->iconAggregator->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->iconAggregator->getMarkerAggregator());
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregateMarkers(array $expected, array $markers = array(), array $icons = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->iconAggregator->aggregateMarkers($map, $icons));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $markers = array(), array $icons = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->iconAggregator->aggregate($map, $icons));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $marker1 = $this->createMarkerMock();
        $marker2 = $this->createMarkerMock($icon1 = $this->createIconMock());
        $marker3 = $this->createMarkerMock(null, $icon2 = $this->createIconMock());
        $marker4 = $this->createMarkerMock(null, $icon3 = $this->createIconMock());
        $marker5 = $this->createMarkerMock($icon1, $icon3);

        $simpleMarkers = array($marker1, $marker2, $marker3);
        $fullMarkers = array($marker1, $marker2, $marker3, $marker4, $marker5);

        $simpleIcons = array($icon1, $icon2);
        $fullIcons = array($icon1, $icon2, $icon3);

        return array(
            array(array()),
            array($simpleIcons, $simpleMarkers),
            array($fullIcons, $fullMarkers),
            array($fullIcons, $fullMarkers, $simpleIcons),
        );
    }

    /**
     * Creates a maker mock.
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
