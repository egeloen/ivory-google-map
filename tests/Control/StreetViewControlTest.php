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
use Ivory\GoogleMap\Control\StreetViewControl;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlTest extends TestCase
{
    private StreetViewControl $streetViewControl;

    protected function setUp(): void
    {
        $this->streetViewControl = new StreetViewControl();
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->streetViewControl->getPosition());
    }

    public function testInitialState()
    {
        $this->streetViewControl = new StreetViewControl($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->streetViewControl->getPosition());
    }

    public function testPosition()
    {
        $this->streetViewControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->streetViewControl->getPosition());
    }
}
