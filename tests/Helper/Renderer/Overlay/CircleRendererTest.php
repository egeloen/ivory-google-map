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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\CircleRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Circle;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CircleRenderer
     */
    private $circleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circleRenderer = new CircleRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->circleRenderer);
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $center = new Coordinate();
        $center->setVariable('center');

        $circle = new Circle($center, 1.2, ['foo' => 'bar']);
        $circle->setVariable('circle');

        $this->assertSame(
            'circle=new google.maps.Circle({"map":map,"center":center,"radius":1.2,"foo":"bar"})',
            $this->circleRenderer->render($circle, $map)
        );
    }
}
