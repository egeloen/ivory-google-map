<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\CustomControlRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CustomControlRenderer
     */
    private $customControlRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->customControlRenderer = new CustomControlRenderer(
            $formatter = new Formatter(),
            new ControlPositionRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->customControlRenderer);
    }

    public function testControlPositionRenderer()
    {
        $controlPositionRenderer = $this->createControlPositionRendererMock();
        $this->customControlRenderer->setControlPositionRenderer($controlPositionRenderer);

        $this->assertSame($controlPositionRenderer, $this->customControlRenderer->getControlPositionRenderer());
    }

    public function testRender()
    {
        $map = new Map();
        $map->setVariable('map');

        $this->assertSame(
            'map.controls[google.maps.ControlPosition.TOP_CENTER].push((function(){control})())',
            $this->customControlRenderer->render(new CustomControl(ControlPosition::TOP_CENTER, 'control'), $map)
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ControlPositionRenderer
     */
    private function createControlPositionRendererMock()
    {
        return $this->createMock(ControlPositionRenderer::class);
    }
}
