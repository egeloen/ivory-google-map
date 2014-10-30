<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers;

/**
 * Json renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer|\PHPUnit_Framework_MockObject_MockObject */
    private $jsonRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->jsonRenderer = $this->createJsonRendererMock();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->jsonRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->jsonRenderer->getJsonBuilder());
    }

    public function testInitialState()
    {
        $this->jsonRenderer = $this->createJsonRendererMockBuilder()
            ->setConstructorArgs(array($jsonBuilder = $this->createJsonBuilderMock()))
            ->getMockForAbstractClass();

        $this->assertSame($jsonBuilder, $this->jsonRenderer->getJsonBuilder());
    }

    public function testSetJsonBuilder()
    {
        $this->jsonRenderer->setJsonBuilder($jsonBuilder = $this->createJsonBuilderMock());

        $this->assertSame($jsonBuilder, $this->jsonRenderer->getJsonBuilder());
    }
}
