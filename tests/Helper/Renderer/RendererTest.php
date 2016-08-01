<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractRenderer
     */
    private $renderer;

    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formatter = $this->createFormatterMock();
        $this->renderer = $this->createAbstractRendererMock($this->formatter);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->formatter, $this->renderer->getFormatter());
    }

    public function testFormatter()
    {
        $this->renderer->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->renderer->getFormatter());
    }

    /**
     * @param Formatter|null $formatter
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractRenderer
     */
    private function createAbstractRendererMock(Formatter $formatter = null)
    {
        return $this->getMockBuilder(AbstractRenderer::class)
            ->setConstructorArgs([$formatter ?: $this->createFormatterMock()])
            ->getMockForAbstractClass();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Formatter
     */
    private function createFormatterMock()
    {
        return $this->createMock(Formatter::class);
    }
}
