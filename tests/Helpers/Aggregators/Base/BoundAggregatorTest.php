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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Bound aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $groundOverlayAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\RectangleAggregator|\PHPUnit_Framework_MockObject_MockObject */
    private $rectangleAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundAggregator = new BoundAggregator(
            $this->groundOverlayAggregator = $this->createGroundOverlayAggregatorMock(),
            $this->rectangleAggregator = $this->createRectangleAggregatorMock()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlayAggregator);
        unset($this->rectangleAggregator);
        unset($this->boundAggregator);
    }

    public function testDefaultState()
    {
        $this->boundAggregator = new BoundAggregator();

        $this->assertGroundOverlayAggregatorInstance($this->boundAggregator->getGroundOverlayAggregator());
        $this->assertRectangleAggregatorInstance($this->boundAggregator->getRectangleAggregator());
    }

    public function testInitialState()
    {
        $this->assertSame($this->groundOverlayAggregator, $this->boundAggregator->getGroundOverlayAggregator());
        $this->assertSame($this->rectangleAggregator, $this->boundAggregator->getRectangleAggregator());
    }

    public function testSetGroundOverlayAggregator()
    {
        $this->boundAggregator->setGroundOverlayAggregator(
            $groundOverlayAggregator = $this->createGroundOverlayAggregatorMock()
        );

        $this->assertSame($groundOverlayAggregator, $this->boundAggregator->getGroundOverlayAggregator());
    }

    public function testSetRectangleAggregator()
    {
        $this->boundAggregator->setRectangleAggregator($rectangleAggregator = $this->createRectangleAggregatorMock());

        $this->assertSame($rectangleAggregator, $this->boundAggregator->getRectangleAggregator());
    }

    /**
     * @dataProvider aggregateGroundOverlaysProvider
     */
    public function testAggregateGroundOverlays(
        array $expected,
        array $groundOverlays = array(),
        array $bounds = array()
    ) {
        $map = $this->createMapMock();

        $this->groundOverlayAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($groundOverlays));

        $this->assertEquals($expected, $this->boundAggregator->aggregateGroundOverlays($map, $bounds));
    }

    /**
     * @dataProvider aggregateRectanglesProvider
     */
    public function testAggregateRectangles(array $expected, array $rectangles = array(), array $bounds = array())
    {
        $map = $this->createMapMock();

        $this->rectangleAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($rectangles));

        $this->assertEquals($expected, $this->boundAggregator->aggregateRectangles($map, $bounds));
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(
        array $expected,
        array $groundOverlays = array(),
        array $rectangles = array(),
        Bound $bound = null,
        array $bounds = array()
    ) {
        $map = $this->createMapMock($bound);

        $this->groundOverlayAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($groundOverlays));

        $this->rectangleAggregator
            ->expects($this->any())
            ->method('aggregate')
            ->with($this->identicalTo($map))
            ->will($this->returnValue($rectangles));

        $this->assertEquals($expected, $this->boundAggregator->aggregate($map, $bounds));
    }

    /**
     * Gets the aggregate ground overlays provider.
     *
     * @return array The aggregate ground overlays provider.
     */
    public function aggregateGroundOverlaysProvider()
    {
        $groundOverlay1 = $this->createGroundOverlayMock($bound1 = $this->createBoundMock());
        $groundOverlay2 = $this->createGroundOverlayMock($bound2 = $this->createBoundMock());
        $groundOverlay3 = $this->createGroundOverlayMock($bound1);

        $simpleGroundOverlays = array($groundOverlay1);
        $fullGroundOverlays = array($groundOverlay1, $groundOverlay2, $groundOverlay3);

        $simpleBounds = array($bound1);
        $fullBounds = array($bound1, $bound2);

        return array(
            array(array()),
            array($simpleBounds, $simpleGroundOverlays),
            array($fullBounds, $fullGroundOverlays),
            array($fullBounds, $fullGroundOverlays, $simpleBounds),
        );
    }

    /**
     * Gets the aggregate rectangles provider.
     *
     * @return array The aggregate rectangles provider.
     */
    public function aggregateRectanglesProvider()
    {
        $rectangle1 = $this->createRectangleMock($bound1 = $this->createBoundMock());
        $rectangle2 = $this->createRectangleMock($bound2 = $this->createBoundMock());
        $rectangle3 = $this->createRectangleMock($bound1);

        $simpleRectangles = array($rectangle1);
        $fullRectangles = array($rectangle1, $rectangle2, $rectangle3);

        $simpleBounds = array($bound1);
        $fullBounds = array($bound1, $bound2);

        return array(
            array(array()),
            array($simpleBounds, $simpleRectangles),
            array($fullBounds, $fullRectangles),
            array($fullBounds, $fullRectangles, $simpleBounds),
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $groundOverlay1 = $this->createGroundOverlayMock($bound1 = $this->createBoundMock());
        $groundOverlay2 = $this->createGroundOverlayMock($bound2 = $this->createBoundMock());
        $groundOverlay3 = $this->createGroundOverlayMock($bound1);

        $rectangle1 = $this->createRectangleMock($bound3 = $this->createBoundMock());
        $rectangle2 = $this->createRectangleMock($bound4 = $this->createBoundMock());
        $rectangle3 = $this->createRectangleMock($bound3);

        $simpleGroundOverlays = array($groundOverlay1);
        $fullGroundOverlays = array($groundOverlay1, $groundOverlay2, $groundOverlay3);

        $simpleRectangles = array($rectangle1);
        $fullRectangles = array($rectangle1, $rectangle2, $rectangle3);

        $simpleBounds = array($bound1, $bound3);
        $fullBounds = array($bound1, $bound2, $bound3, $bound4);

        return array(
            array(array()),
            array($simpleBounds, $simpleGroundOverlays, $simpleRectangles),
            array($fullBounds, $fullGroundOverlays, $fullRectangles),
            array(
                array_merge(array($mapBound = $this->createBoundMock()), $fullBounds),
                $fullGroundOverlays,
                $fullRectangles,
                $mapBound,
            ),
            array(
                array_merge(array($mapBound = $this->createBoundMock()), $fullBounds),
                $fullGroundOverlays,
                $fullRectangles,
                $mapBound,
                array($mapBound, $bound1),
            ),
        );
    }

    /**
     * Creates a ground overlay mock.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     *
     * @return \Ivory\GoogleMap\Overlays\GroundOverlay|\PHPUnit_Framework_MockObject_MockObject The ground overlay mock.
     */
    protected function createGroundOverlayMock(Bound $bound = null)
    {
        $groundOverlay = parent::createGroundOverlayMock();
        $groundOverlay
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound));

        return $groundOverlay;
    }

    /**
     * Creates a map mock.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(Bound $bound = null)
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock()));

        if ($bound !== null) {
            $overlays
                ->expects($this->any())
                ->method('isAutoZoom')
                ->will($this->returnValue(true));

            $map
                ->expects($this->any())
                ->method('getBound')
                ->will($this->returnValue($bound));
        }

        return $map;
    }

    /**
     * Creates a rectangle mock.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     *
     * @return \Ivory\GoogleMap\Overlays\Rectangle|\PHPUnit_Framework_MockObject_MockObject The rectangle mock.
     */
    protected function createRectangleMock(Bound $bound = null)
    {
        $rectangle = parent::createRectangleMock();
        $rectangle
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($bound));

        return $rectangle;
    }
}
