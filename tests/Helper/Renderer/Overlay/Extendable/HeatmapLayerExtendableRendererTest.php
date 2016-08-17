<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Overlay\Extendable;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\ExtendableRendererInterface;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\HeatmapLayerExtendableRenderer;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeatmapLayerExtendableRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HeatmapLayerExtendableRenderer
     */
    private $heatmapLayerExtendableRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->heatmapLayerExtendableRenderer = new HeatmapLayerExtendableRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->heatmapLayerExtendableRenderer);
        $this->assertInstanceOf(ExtendableRendererInterface::class, $this->heatmapLayerExtendableRenderer);
    }

    public function testRender()
    {
        $extendable = $this->createExtendableMock();
        $extendable
            ->expects($this->once())
            ->method('getVariable')
            ->will($this->returnValue('extendable'));

        $bound = $this->createBoundMock();
        $bound
            ->expects($this->once())
            ->method('getVariable')
            ->will($this->returnValue('bound'));

        $this->assertSame(
            'extendable.getData().forEach(function(c){bound.extend(c)})',
            $this->heatmapLayerExtendableRenderer->render($extendable, $bound)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ExtendableInterface
     */
    private function createExtendableMock()
    {
        return $this->createMock(ExtendableInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
