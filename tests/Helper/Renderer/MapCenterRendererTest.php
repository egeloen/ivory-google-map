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
use Ivory\GoogleMap\Helper\Renderer\MapCenterRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapCenterRenderer
     */
    private $mapCenterRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapCenterRenderer = new MapCenterRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->mapCenterRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');
        $map->getCenter()->setVariable('center');

        $this->assertSame('map.setCenter(center)', $this->mapCenterRenderer->render($map));
    }
}
