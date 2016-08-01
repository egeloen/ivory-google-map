<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapBoundRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBoundRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapBoundRenderer
     */
    private $mapBoundRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapBoundRenderer = new MapBoundRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->mapBoundRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->getBound()->setVariable('bound');

        $this->assertSame('map.fitBounds(bound)', $this->mapBoundRenderer->render($map));
    }
}
