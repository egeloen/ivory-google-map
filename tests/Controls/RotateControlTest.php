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
use Ivory\GoogleMap\Controls\RotateControl;

/**
 * Rotate control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\RotateControl */
    private $rotateControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControl = new RotateControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->rotateControl->getControlPosition());
    }

    public function testInitialState()
    {
        $this->rotateControl = new RotateControl($controlPosition = ControlPosition::LEFT_CENTER);

        $this->assertSame($controlPosition, $this->rotateControl->getControlPosition());
    }

    public function testSetControlPosition()
    {
        $this->rotateControl->setControlPosition($controlPosition = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($controlPosition, $this->rotateControl->getControlPosition());
    }
}
