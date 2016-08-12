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

use Ivory\GoogleMap\Helper\Collector\Layer\KmlLayerCollector;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayerCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KmlLayerCollector
     */
    private $kmlLayerCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerCollector = new KmlLayerCollector();
    }

    public function testCollect()
    {
        $map = new Map();
        $map->getLayerManager()->addKmlLayer($kmlLayer = new KmlLayer('url'));

        $this->assertSame([$kmlLayer], $this->kmlLayerCollector->collect($map));
    }
}
