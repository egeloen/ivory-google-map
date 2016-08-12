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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\AbstractInfoWindowRenderer;
use Ivory\GoogleMap\Helper\Renderer\Overlay\InfoBoxRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoBoxRenderer
     */
    private $infoBoxRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoBoxRenderer = new InfoBoxRenderer(
            $formatter = new Formatter(),
            new JsonBuilder(),
            new RequirementRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractInfoWindowRenderer::class, $this->infoBoxRenderer);
    }

    public function testRequirementRenderer()
    {
        $this->infoBoxRenderer->setRequirementRenderer($requirementRenderer = $this->createRequirementRendererMock());

        $this->assertSame($requirementRenderer, $this->infoBoxRenderer->getRequirementRenderer());
    }

    public function testRender()
    {
        $position = new Coordinate();
        $position->setVariable('position');

        $pixelOffset = new Size();
        $pixelOffset->setVariable('pixel_offset');

        $infoWindow = new InfoWindow('content', InfoWindowType::INFO_BOX, $position);
        $infoWindow->setVariable('info_window');
        $infoWindow->setPixelOffset($pixelOffset);
        $infoWindow->setOptions(['foo' => 'bar']);

        $this->assertSame(
            'info_window=new InfoBox({"position":position,"pixelOffset":pixel_offset,"content":"content","foo":"bar"})',
            $this->infoBoxRenderer->render($infoWindow)
        );
    }

    public function testRenderWithoutPosition()
    {
        $infoWindow = new InfoWindow('content');
        $infoWindow->setVariable('info_window');

        $this->assertSame(
            'info_window=new InfoBox({"content":"content"})',
            $this->infoBoxRenderer->render($infoWindow, false)
        );
    }

    public function testRenderSource()
    {
        $this->assertSame(
            'https://cdn.rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox_packed.js',
            $this->infoBoxRenderer->renderSource()
        );
    }

    public function testRenderRequirement()
    {
        $this->assertSame('typeof InfoBox!==typeof undefined', $this->infoBoxRenderer->renderRequirement());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequirementRenderer
     */
    private function createRequirementRendererMock()
    {
        return $this->createMock(RequirementRenderer::class);
    }
}
