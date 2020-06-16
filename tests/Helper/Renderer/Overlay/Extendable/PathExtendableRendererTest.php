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
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\PathExtendableRenderer;
use Ivory\GoogleMap\Overlay\ExtendableInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PathExtendableRendererTest extends TestCase
{
    /**
     * @var PathExtendableRenderer
     */
    private $pathExtendableRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pathExtendableRenderer = new PathExtendableRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->pathExtendableRenderer);
        $this->assertInstanceOf(ExtendableRendererInterface::class, $this->pathExtendableRenderer);
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
            'extendable.getPath().forEach(function(c){bound.extend(c)})',
            $this->pathExtendableRenderer->render($extendable, $bound)
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
