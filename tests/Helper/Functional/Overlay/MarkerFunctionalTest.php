<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MarkerFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $map = new Map();
        $map->getOverlayManager()->addMarker($this->createMarker());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);
        $map->getOverlayManager()->addMarker($this->createMarker());

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithAnimation()
    {
        $marker = $this->createMarker();
        $marker->setAnimation(Animation::BOUNCE);

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithIcon()
    {
        $marker = $this->createMarker();
        $marker->setIcon(new Icon());

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithSymbol()
    {
        $marker = $this->createMarker();
        $marker->setSymbol(new Symbol(SymbolPath::CIRCLE));

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithShape()
    {
        $marker = $this->createMarker();
        $marker->setIcon(new Icon());
        $marker->setShape(new MarkerShape(MarkerShapeType::POLY, [1, 1, 1, 20, 18, 20, 18, 1]));

        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    /**
     * @return Marker
     */
    private function createMarker()
    {
        return new Marker(new Coordinate());
    }
}
