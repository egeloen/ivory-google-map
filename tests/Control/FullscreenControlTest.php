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
use Ivory\GoogleMap\Control\FullscreenControl;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class FullscreenControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FullscreenControl
     */
    private $fullscreenControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->fullscreenControl = new FullscreenControl();
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::RIGHT_TOP, $this->fullscreenControl->getPosition());
    }

    public function testInitialState()
    {
        $this->fullscreenControl = new FullscreenControl($position = ControlPosition::LEFT_CENTER);

        $this->assertSame($position, $this->fullscreenControl->getPosition());
    }

    public function testPosition()
    {
        $this->fullscreenControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->fullscreenControl->getPosition());
    }
}
