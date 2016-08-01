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
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlPositionRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ControlPositionRenderer
     */
    private $controlPositionRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlPositionRenderer = new ControlPositionRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->controlPositionRenderer);
    }

    public function testRender()
    {
        $this->assertSame(
            'google.maps.ControlPosition.TOP_LEFT',
            $this->controlPositionRenderer->render(ControlPosition::TOP_LEFT)
        );
    }
}
