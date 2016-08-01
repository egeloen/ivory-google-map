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
use Ivory\GoogleMap\Control\RotateControl;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RotateControl
     */
    private $rotateControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControl = new RotateControl();
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->rotateControl->getPosition());
    }

    public function testInitialState()
    {
        $this->rotateControl = new RotateControl($position = ControlPosition::LEFT_CENTER);

        $this->assertSame($position, $this->rotateControl->getPosition());
    }

    public function testPosition()
    {
        $this->rotateControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->rotateControl->getPosition());
    }
}
