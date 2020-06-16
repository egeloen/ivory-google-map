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

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\MarkerShapeRenderer;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeRendererTest extends TestCase
{
    /**
     * @var MarkerShapeRenderer
     */
    private $markerShapeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShapeRenderer = new MarkerShapeRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->markerShapeRenderer);
    }

    public function testRender()
    {
        $markerShape = new MarkerShape(MarkerShapeType::CIRCLE, [1.2, 2.3, 3.4]);
        $markerShape->setVariable('marker_shape');

        $this->assertSame(
            'marker_shape={"type":"circle","coords":[1.2,2.3,3.4]}',
            $this->markerShapeRenderer->render($markerShape)
        );
    }
}
