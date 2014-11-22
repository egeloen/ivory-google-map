<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\MarkerShapes;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator;
use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Marker shape aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerShapeAggregator */
    private $markerShapeAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $markerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShapeAggregator = new MarkerShapeAggregator(
            $this->markerAggregator = $this->createMarkerAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerAggregator);
        unset($this->markerShapeAggregator);
    }

    public function testDefaultState()
    {
        $this->markerShapeAggregator = new MarkerShapeAggregator();

        $this->assertMarkerAggregatorInstance($this->markerShapeAggregator->getMarkerAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->markerAggregator, $this->markerShapeAggregator->getMarkerAggregator());
    }

    public function testSetMarkerAggregator()
    {
        $this->markerShapeAggregator->setMarkerAggregator($markerAggregator = $this->createMarkerAggregatorMock());

        $this->assertSame($markerAggregator, $this->markerShapeAggregator->getMarkerAggregator());
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregateMarkers(array $expected, array $markers = array(), array $markerShapes = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->markerShapeAggregator->aggregateMarkers($map, $markerShapes));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $markers = array(), array $markerShapes = array())
    {
        $this->markerAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($markers));

        $this->assertEquals($expected, $this->markerShapeAggregator->aggregate($map, $markerShapes));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $marker1 = $this->createMarkerMock();
        $marker2 = $this->createMarkerMock($markerShape1 = $this->createMarkerShapeMock());
        $marker3 = $this->createMarkerMock($markerShape2 = $this->createMarkerShapeMock());
        $marker4 = $this->createMarkerMock($markerShape1);

        $simpleMarkers = array($marker1, $marker2);
        $fullMarkers = array($marker1, $marker2, $marker3, $marker4);

        $simpleMarkerShapes = array($markerShape1);
        $fullMarkerShapes = array($markerShape1, $markerShape2);

        return array(
            array(array()),
            array($simpleMarkerShapes, $simpleMarkers),
            array($fullMarkerShapes, $fullMarkers),
            array($fullMarkerShapes, $fullMarkers, $simpleMarkerShapes),
        );
    }

    /**
     * Creates a maker mock.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape|null $markerShape The marker shape.
     *
     * @return \Ivory\GoogleMap\Overlays\Marker|\PHPUnit_Framework_MockObject_MockObject The marker mock.
     */
    protected function createMarkerMock(MarkerShape $markerShape = null)
    {
        $marker = parent::createMarkerMock();

        if ($markerShape !== null) {
            $marker
                ->expects($this->any())
                ->method('hasShape')
                ->will($this->returnValue(true));

            $marker
                ->expects($this->any())
                ->method('getShape')
                ->will($this->returnValue($markerShape));
        }

        return $marker;
    }
}
