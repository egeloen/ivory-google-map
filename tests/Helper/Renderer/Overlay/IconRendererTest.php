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
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconRenderer;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconRendererTest extends \PHPUnit_Framework_TestCase
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
        $this->assertInstanceOf(AbstractRenderer::class, $this->iconRenderer);
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

        $this->assertSame(
            '{"url":"url","anchor":anchor,"origin":origin,"scaledSize":scaled_size,"size":scaled_size}',
            $this->iconRenderer->render(new Icon('url', $anchor, $origin, $scaledSize, $size))
        );
    }

    public function testRenderWithoutOptions()
    {
        $this->assertSame(
            '{"url":"https:\/\/maps.gstatic.com\/mapfiles\/markers\/marker.png"}',
            $this->iconRenderer->render(new Icon())
        );
    }
}
