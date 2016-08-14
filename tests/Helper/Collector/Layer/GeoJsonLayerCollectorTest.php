<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Layer;

use Ivory\GoogleMap\Helper\Collector\Layer\GeoJsonLayerCollector;
use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeoJsonLayerCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeoJsonLayerCollector
     */
    private $geoJsonLayerCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geoJsonLayerCollector = new GeoJsonLayerCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getLayerManager()->addGeoJsonLayer($geoJsonLayer = new GeoJsonLayer('url'));

        $this->assertSame([$geoJsonLayer], $this->geoJsonLayerCollector->collect($map));
    }
}
