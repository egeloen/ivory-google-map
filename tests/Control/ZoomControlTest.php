<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Control;

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Control\ZoomControlStyle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ZoomControl
     */
    private $zoomControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControl = new ZoomControl();
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->zoomControl->getPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $this->zoomControl->getStyle());
    }

    public function testInitialState()
    {
        $this->zoomControl = new ZoomControl(
            $position = ControlPosition::BOTTOM_CENTER,
            $style = ZoomControlStyle::LARGE
        );

        $this->assertSame($position, $this->zoomControl->getPosition());
        $this->assertSame($style, $this->zoomControl->getStyle());
    }

    public function testPosition()
    {
        $this->zoomControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->zoomControl->getPosition());
    }

    public function testStyle()
    {
        $this->zoomControl->setStyle($style = ZoomControlStyle::LARGE);

        $this->assertSame($style, $this->zoomControl->getStyle());
    }
}
