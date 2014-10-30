<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\GroundOverlays;

use Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Ground overlay aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\GroundOverlayAggregator */
    private $groundOverlayAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlayAggregator = new GroundOverlayAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlayAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $groundOverlays = array(), array $base = array())
    {
        $this->assertEquals(
            $expected,
            $this->groundOverlayAggregator->aggregate($this->createMapMock($groundOverlays), $base)
        );
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $groundOverlay1 = $this->createGroundOverlayMock();
        $groundOverlay2 = $this->createGroundOverlayMock();

        $simpleGroundOverlays = array($groundOverlay1, $groundOverlay2);
        $fullGroundOverlays = array($groundOverlay1, $groundOverlay2, $groundOverlay1);

        return array(
            array(array()),
            array($simpleGroundOverlays, $simpleGroundOverlays),
            array($simpleGroundOverlays, $fullGroundOverlays),
            array($simpleGroundOverlays, $fullGroundOverlays),
            array($simpleGroundOverlays, $fullGroundOverlays, array($groundOverlay1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $groundOverlays The ground overlays.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $groundOverlays = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getOverlays')
            ->will($this->returnValue($overlays = $this->createOverlaysMock($groundOverlays)));

        return $map;
    }

    /**
     * Creates an overlays mock.
     *
     * @param array $groundOverlays The ground overlays.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays|\PHPUnit_Framework_MockObject_MockObject The overlays mock.
     */
    protected function createOverlaysMock(array $groundOverlays = array())
    {
        $overlays = parent::createOverlaysMock();
        $overlays
            ->expects($this->any())
            ->method('getGroundOverlays')
            ->will($this->returnValue($groundOverlays));

        return $overlays;
    }
}
