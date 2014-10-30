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
use Ivory\GoogleMap\Controls\PanControl;

/**
 * Pan control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\PanControl */
    private $panControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControl = new PanControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->panControl->getControlPosition());
    }

    public function testInitialState()
    {
        $this->panControl = new PanControl($controlPosition = ControlPosition::LEFT_CENTER);

        $this->assertSame($controlPosition, $this->panControl->getControlPosition());
    }

    public function testSetControlPosition()
    {
        $this->panControl->setControlPosition($controlPosition = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($controlPosition, $this->panControl->getControlPosition());
    }
}
