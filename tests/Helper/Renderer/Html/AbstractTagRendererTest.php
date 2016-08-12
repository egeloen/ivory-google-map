<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractTagRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractTagRenderer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $tagRenderer;

    /**
     * @var TagRenderer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $innerTagRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->innerTagRenderer = $this->createTagRendererMock();
        $this->tagRenderer = $this->createAbstractTagRendererMock($this->innerTagRenderer);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->tagRenderer);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->innerTagRenderer, $this->tagRenderer->getTagRenderer());
    }

    public function testTagRenderer()
    {
        $this->tagRenderer->setTagRenderer($tagRenderer = $this->createTagRendererMock());

        $this->assertSame($tagRenderer, $this->tagRenderer->getTagRenderer());
    }

    /**
     * @param TagRenderer|null $tagRenderer
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractTagRenderer
     */
    private function createAbstractTagRendererMock(TagRenderer $tagRenderer = null)
    {
        return $this->getMockBuilder(AbstractTagRenderer::class)
            ->setConstructorArgs([$this->createFormatterMock(), $tagRenderer ?: $this->createTagRendererMock()])
            ->getMockForAbstractClass();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Formatter
     */
    private function createFormatterMock()
    {
        return $this->createMock(Formatter::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|TagRenderer
     */
    private function createTagRendererMock()
    {
        return $this->createMock(TagRenderer::class);
    }
}
