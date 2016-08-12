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
use Ivory\GoogleMap\Helper\Renderer\Overlay\RectangleRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Rectangle;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RectangleRenderer
     */
    private $rectangleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangleRenderer = new RectangleRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->rectangleRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $bound = new Bound();
        $bound->setVariable('bound');

        $rectangle = new Rectangle($bound, ['foo' => 'bar']);
        $rectangle->setVariable('rectangle');

        $this->assertSame(
            'rectangle=new google.maps.Rectangle({"map":map,"bounds":bound,"foo":"bar"})',
            $this->rectangleRenderer->render($rectangle, $map)
        );
    }
}
