<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\GroundOverlayRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\GroundOverlay;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GroundOverlayRenderer
     */
    private $groundOverlayRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->groundOverlayRenderer = new GroundOverlayRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->groundOverlayRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $bound = new Bound();
        $bound->setVariable('bound');

        $groundOverlay = new GroundOverlay('url', $bound, ['foo' => 'bar']);
        $groundOverlay->setVariable('ground_overlay');

        $this->assertSame(
            'ground_overlay=new google.maps.GroundOverlay("url",bound,{"map":map,"foo":"bar"})',
            $this->groundOverlayRenderer->render($groundOverlay, $map)
        );
    }
}
