<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Layer;

use Ivory\GoogleMap\Layer\GeoJsonLayer;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class GeoJsonLayerFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getLayerManager()->addGeoJsonLayer($this->createGeoJsonLayer());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return GeoJsonLayer
     */
    private function createGeoJsonLayer()
    {
        return new GeoJsonLayer('https://storage.googleapis.com/mapsdevsite/json/google.json');
    }
}
