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

use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Map;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class KmlLayerFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getLayerManager()->addKmlLayer($this->createKmlLayer());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return KmlLayer
     */
    private function createKmlLayer()
    {
        return new KmlLayer('https://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml');
    }
}
