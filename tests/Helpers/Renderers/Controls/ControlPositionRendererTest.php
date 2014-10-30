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

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer;
use Ivory\Tests\GoogleMap\Helpers\Renderers\AbstractTestCase;

/**
 * Control position renderer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionRendererTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer */
    private $controlPositionRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlPositionRenderer = new ControlPositionRenderer();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->controlPositionRenderer);
    }

    /**
     * @dataProvider renderProvider
     */
    public function testRender($expected, $controlPosition)
    {
        $this->assertSame($expected, $this->controlPositionRenderer->render($controlPosition));
    }

    /**
     * Gets the render provider.
     *
     * @return array The render provider.
     */
    public function renderProvider()
    {
        return array(
            array('google.maps.ControlPosition.BOTTOM_CENTER', ControlPosition::BOTTOM_CENTER),
            array('google.maps.ControlPosition.BOTTOM_LEFT', ControlPosition::BOTTOM_LEFT),
            array('google.maps.ControlPosition.BOTTOM_RIGHT', ControlPosition::BOTTOM_RIGHT),
            array('google.maps.ControlPosition.LEFT_BOTTOM', ControlPosition::LEFT_BOTTOM),
            array('google.maps.ControlPosition.LEFT_CENTER', ControlPosition::LEFT_CENTER),
            array('google.maps.ControlPosition.LEFT_TOP', ControlPosition::LEFT_TOP),
            array('google.maps.ControlPosition.RIGHT_BOTTOM', ControlPosition::RIGHT_BOTTOM),
            array('google.maps.ControlPosition.RIGHT_CENTER', ControlPosition::RIGHT_CENTER),
            array('google.maps.ControlPosition.RIGHT_TOP', ControlPosition::RIGHT_TOP),
            array('google.maps.ControlPosition.TOP_CENTER', ControlPosition::TOP_CENTER),
            array('google.maps.ControlPosition.TOP_LEFT', ControlPosition::TOP_LEFT),
            array('google.maps.ControlPosition.TOP_RIGHT', ControlPosition::TOP_RIGHT),
        );
    }
}
