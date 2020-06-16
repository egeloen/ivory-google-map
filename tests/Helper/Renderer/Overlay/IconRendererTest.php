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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\JsonBuilder\JsonBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconRendererTest extends TestCase
{
    /**
     * @var IconRenderer
     */
    private $iconRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->iconRenderer = new IconRenderer(new Formatter(), new JsonBuilder());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJsonRenderer::class, $this->iconRenderer);
    }

    public function testRender()
    {
        $size = new Size();
        $size->setVariable('size');

        $origin = new Point();
        $origin->setVariable('origin');

        $anchor = new Point();
        $anchor->setVariable('anchor');

        $scaledSize = new Size();
        $scaledSize->setVariable('scaled_size');

        $icon = new Icon('url', $anchor, $origin, $scaledSize, $size);
        $icon->setVariable('icon');

        $this->assertSame(
            'icon={"url":"url","anchor":anchor,"origin":origin,"scaledSize":scaled_size,"size":scaled_size}',
            $this->iconRenderer->render($icon)
        );
    }

    public function testRenderWithoutOptions()
    {
        $icon = new Icon();
        $icon->setVariable('icon');

        $this->assertSame(
            'icon={"url":"https:\/\/maps.gstatic.com\/mapfiles\/markers\/marker.png"}',
            $this->iconRenderer->render($icon)
        );
    }
}
