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

use Ivory\GoogleMap\Helper\Collector\Layer\HeatmapLayerCollector;
use Ivory\GoogleMap\Layer\HeatmapLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HeatmapLayerCollector
     */
    private $heatmapLayerCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->heatmapLayerCollector = new HeatmapLayerCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getLayerManager()->addHeatmapLayer($heatmapLayer = new HeatmapLayer());

        $this->assertSame([$heatmapLayer], $this->heatmapLayerCollector->collect($map));
    }
}
