<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Aggregators\KmlLayers;

use Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator;
use Ivory\Tests\GoogleMap\Helpers\AbstractTestCase;

/**
 * Kml layer aggregator test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerAggregatorTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Layers\KmlLayerAggregator */
    private $kmlLayerAggregator;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerAggregator = new KmlLayerAggregator();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->kmlLayerAggregator);
    }

    /**
     * @dataProvider aggregateProvider
     */
    public function testAggregate(array $expected, array $kmlLayers = array(), array $base = array())
    {
        $this->assertEquals($expected, $this->kmlLayerAggregator->aggregate($this->createMapMock($kmlLayers), $base));
    }

    /**
     * Gets the aggregate provider.
     *
     * @return array The aggregate provider.
     */
    public function aggregateProvider()
    {
        $kmlLayer1 = $this->createKmlLayerMock();
        $kmlLayer2 = $this->createKmlLayerMock();

        $simpleKmlLayers = array($kmlLayer1, $kmlLayer2);
        $fullKmlLayers = array($kmlLayer1, $kmlLayer2, $kmlLayer1);

        return array(
            array(array()),
            array($simpleKmlLayers, $simpleKmlLayers),
            array($simpleKmlLayers, $fullKmlLayers),
            array($simpleKmlLayers, $fullKmlLayers),
            array($simpleKmlLayers, $fullKmlLayers, array($kmlLayer1)),
        );
    }

    /**
     * Creates a map mock.
     *
     * @param array $kmlLayers The kml layers.
     *
     * @return \Ivory\GoogleMap\Map|\PHPUnit_Framework_MockObject_MockObject The map mock.
     */
    protected function createMapMock(array $kmlLayers = array())
    {
        $map = parent::createMapMock();
        $map
            ->expects($this->any())
            ->method('getLayers')
            ->will($this->returnValue($overlays = $this->createLayersMock($kmlLayers)));

        return $map;
    }

    /**
     * Creates an layers mock.
     *
     * @param array $kmlLayers The kml layers.
     *
     * @return \Ivory\GoogleMap\Layers\Layers|\PHPUnit_Framework_MockObject_MockObject The layers mock.
     */
    protected function createLayersMock(array $kmlLayers = array())
    {
        $layers = parent::createLayersMock();
        $layers
            ->expects($this->any())
            ->method('getKmlLayers')
            ->will($this->returnValue($kmlLayers));

        return $layers;
    }
}
