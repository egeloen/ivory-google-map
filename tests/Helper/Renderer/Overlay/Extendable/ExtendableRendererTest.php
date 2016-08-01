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
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\ExtendableRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\Extendable\ExtendableRendererInterface;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ExtendableRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExtendableRenderer
     */
    private $extendableRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->extendableRenderer = new ExtendableRenderer();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ExtendableRendererInterface::class, $this->extendableRenderer);
    }

    public function testSetRenderers()
    {
        $renderers = [$name = 'foo' => $renderer = $this->createExtendableRendererMock()];

        $this->extendableRenderer->setRenderers($renderers);
        $this->extendableRenderer->setRenderers($renderers);

        $this->assertTrue($this->extendableRenderer->hasRenderers());
        $this->assertTrue($this->extendableRenderer->hasRenderer($name));
        $this->assertSame($renderer, $this->extendableRenderer->getRenderer($name));
        $this->assertSame($renderers, $this->extendableRenderer->getRenderers());
    }

    public function testAddRenderers()
    {
        $firstRenderers = ['foo' => $this->createExtendableRendererMock()];
        $secondRenderers = ['bar' => $this->createExtendableRendererMock()];

        $this->extendableRenderer->setRenderers($firstRenderers);
        $this->extendableRenderer->addRenderers($secondRenderers);

        $this->assertTrue($this->extendableRenderer->hasRenderers());
        $this->assertSame(array_merge($firstRenderers, $secondRenderers), $this->extendableRenderer->getRenderers());
    }

    public function testSetRenderer()
    {
        $this->extendableRenderer->setRenderer($name = 'foo', $renderer = $this->createExtendableRendererMock());

        $this->assertTrue($this->extendableRenderer->hasRenderers());
        $this->assertTrue($this->extendableRenderer->hasRenderer($name));
        $this->assertSame($renderer, $this->extendableRenderer->getRenderer($name));
        $this->assertSame([$name => $renderer], $this->extendableRenderer->getRenderers());
    }

    public function testRemoveRenderer()
    {
        $this->extendableRenderer->setRenderer($name = 'foo', $this->createExtendableRendererMock());
        $this->extendableRenderer->removeRenderer($name);

        $this->assertFalse($this->extendableRenderer->hasRenderers());
        $this->assertFalse($this->extendableRenderer->hasRenderer($name));
        $this->assertNull($this->extendableRenderer->getRenderer($name));
        $this->assertEmpty($this->extendableRenderer->getRenderers());
    }

    public function testRender()
    {
        $extendableRenderer = $this->createExtendableRendererMock();
        $extendableRenderer
            ->expects($this->once())
            ->method('render')
            ->with(
                $this->identicalTo($extendable = $this->createExtendableMock()),
                $this->identicalTo($bound = $this->createBoundMock())
            )
            ->will($this->returnValue($result = 'result'));

        $this->extendableRenderer->setRenderer(get_class($extendable), $extendableRenderer);

        $this->assertSame($result, $this->extendableRenderer->render($extendable, $bound));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp  /The extendable renderer for ".*" could not be found\./
     */
    public function testRenderWithInvalidExtendable()
    {
        $this->extendableRenderer->render($this->createExtendableMock(), $this->createBoundMock());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ExtendableRendererInterface
     */
    private function createExtendableRendererMock()
    {
        return $this->createMock(ExtendableRendererInterface::class);
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
