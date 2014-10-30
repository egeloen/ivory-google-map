<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Controls\ZoomControlStyle;

/**
 * Zoom control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\ZoomControl */
    private $zoomControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControl = new ZoomControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $this->zoomControl->getZoomControlStyle());
    }

    public function testInitialState()
    {
        $this->zoomControl = new ZoomControl(
            $controlPosition = ControlPosition::BOTTOM_CENTER,
            $zoomControlStyle = ZoomControlStyle::LARGE
        );

        $this->assertSame($controlPosition, $this->zoomControl->getControlPosition());
        $this->assertSame($zoomControlStyle, $this->zoomControl->getZoomControlStyle());
    }

    public function testSetControlPosition()
    {
        $this->zoomControl->setControlPosition($controlPosition = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($controlPosition, $this->zoomControl->getControlPosition());
    }

    public function testSetZoomControlStyle()
    {
        $this->zoomControl->setZoomControlStyle($zoomControlStyle = ZoomControlStyle::LARGE);

        $this->assertSame($zoomControlStyle, $this->zoomControl->getZoomControlStyle());
    }
}
