<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MapFunctionalTest extends AbstractMapFunctionalTest
{
    public function testRender()
    {
        $this->renderMap($map = new Map());
        $this->assertMap($map);
    }

    public function testRenderWithAutoZoom()
    {
        $map = new Map();
        $map->setAutoZoom(true);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithLibraries()
    {
        $map = new Map();
        $map->addLibrary('drawing');

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithMapOptions()
    {
        $map = new Map();
        $map->setMapOption('disableDoubleClickZoom', true);

        $this->renderMap($map);
        $this->assertMap($map);
    }

    public function testRenderWithStylesheetOptions()
    {
        $map = new Map();
        $map->setMapOption('position', 'absolute');

        $this->renderMap($map);
        $this->assertMap($map);
    }
}
