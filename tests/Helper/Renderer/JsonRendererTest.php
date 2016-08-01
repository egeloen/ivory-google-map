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
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractJsonRenderer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $jsonRenderer;

    /**
     * @var JsonBuilder|\PHPUnit_Framework_MockObject_MockObject
     */
    private $jsonBuilder;

    /**
     * @var Formatter|\PHPUnit_Framework_MockObject_MockObject
     */
    private $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->formatter = $this->createFormatterMock();
        $this->jsonBuilder = $this->createJsonBuilderMock();

        $this->jsonRenderer = $this->createAbstractJsonRendererMock($this->formatter, $this->jsonBuilder);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->jsonRenderer);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->formatter, $this->jsonRenderer->getFormatter());
        $this->assertNotSame($this->jsonBuilder, $this->jsonRenderer->getJsonBuilder());
        $this->assertInstanceOf(JsonBuilder::class, $this->jsonRenderer->getJsonBuilder());
    }

    public function testJsonBuilder()
    {
        $this->jsonRenderer->setJsonBuilder($jsonBuilder = $this->createJsonBuilderMock());

        $this->assertNotSame($jsonBuilder, $this->jsonRenderer->getJsonBuilder());
        $this->assertInstanceOf(JsonBuilder::class, $this->jsonRenderer->getJsonBuilder());
    }

    /**
     * @param Formatter|null   $formatter
     * @param JsonBuilder|null $jsonBuilder
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractJsonRenderer
     */
    private function createAbstractJsonRendererMock(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        return $this->getMockBuilder(AbstractJsonRenderer::class)
            ->setConstructorArgs([
                $formatter ?: $this->createFormatterMock(),
                $jsonBuilder ?: $this->createJsonBuilderMock(),
            ])
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
     * @return \PHPUnit_Framework_MockObject_MockObject|JsonBuilder
     */
    private function createJsonBuilderMock()
    {
        $jsonBuilder = $this->createMock(JsonBuilder::class);
        $jsonBuilder
            ->expects($this->any())
            ->method('reset')
            ->will($this->returnSelf());

        $jsonBuilder
            ->expects($this->any())
            ->method('setJsonEncodeOptions')
            ->will($this->returnSelf());

        return $jsonBuilder;
    }
}
