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
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

/**
 * Scale control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Controls\ScaleControl */
    protected $scaleControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControl = new ScaleControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::BOTTOM_LEFT, $this->scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getScaleControlStyle());
    }

    public function testInitialState()
    {
        $this->scaleControl = new ScaleControl(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getScaleControlStyle());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->scaleControl->setControlPosition('foo');
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The scale control style of a scale control can only be : default.
     */
    public function testScaleControlStyleWithInvalidValue()
    {
        $this->scaleControl->setScaleControlStyle('foo');
    }
}
