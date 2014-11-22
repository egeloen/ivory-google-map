<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Scale control renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer */
    private $scaleControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlRenderer = new ScaleControlRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlRenderer);
    }

    public function testInheritance()
    {
        $this->assertJsonRendererInstance($this->scaleControlRenderer);
    }

    public function testDefaultState()
    {
        $this->assertJsonBuilderInstance($this->scaleControlRenderer->getJsonBuilder());
        $this->assertScaleControlStyleRendererInstance($this->scaleControlRenderer->getScaleControlStyleRenderer());
    }

    public function testInitialState()
    {
        $this->scaleControlRenderer = new ScaleControlRenderer(
            $jsonBuilder = $this->createJsonBuilderMock(),
            $scaleControlStyleRenderer = $this->createScaleControlStyleRendererMock()
        );

        $this->assertSame($jsonBuilder, $this->scaleControlRenderer->getJsonBuilder());
        $this->assertSame($scaleControlStyleRenderer, $this->scaleControlRenderer->getScaleControlStyleRenderer());
    }

    public function testSetScaleControlStyleRenderer()
    {
        $this->scaleControlRenderer->setScaleControlStyleRenderer(
            $scaleControlStyleRenderer = $this->createScaleControlStyleRendererMock()
        );

        $this->assertSame($scaleControlStyleRenderer, $this->scaleControlRenderer->getScaleControlStyleRenderer());
    }

    public function testRender()
    {
        $scaleControl = $this->createScaleControlMock();
        $scaleControl
            ->expects($this->any())
            ->method('getScaleControlStyle')
            ->will($this->returnValue(ScaleControlStyle::DEFAULT_));

        $this->assertSame(
            '{"style":google.maps.ScaleControlStyle.DEFAULT}',
            $this->scaleControlRenderer->render($scaleControl)
        );
    }
}
