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
use Ivory\GoogleMap\Controls\StreetViewControl;

/**
 * Street view control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\StreetViewControl */
    private $streetViewControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControl = new StreetViewControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->streetViewControl->getControlPosition());
    }

    public function testInitialState()
    {
        $this->streetViewControl = new StreetViewControl($controlPosition = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($controlPosition, $this->streetViewControl->getControlPosition());
    }

    public function testSetControlPosition()
    {
        $this->streetViewControl->setControlPosition($controlPosition = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($controlPosition, $this->streetViewControl->getControlPosition());
    }
}
