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
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Control\ScaleControlStyle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ScaleControl
     */
    private $scaleControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControl = new ScaleControl();
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::BOTTOM_LEFT, $this->scaleControl->getPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getStyle());
    }

    public function testInitialState()
    {
        $this->scaleControl = new ScaleControl(
            $position = ControlPosition::BOTTOM_CENTER,
            $style = ScaleControlStyle::DEFAULT_
        );

        $this->assertSame($position, $this->scaleControl->getPosition());
        $this->assertSame($style, $this->scaleControl->getStyle());
    }

    public function testPosition()
    {
        $this->scaleControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->scaleControl->getPosition());
    }

    public function testStyle()
    {
        $this->scaleControl->setStyle($style = ScaleControlStyle::DEFAULT_);

        $this->assertSame($style, $this->scaleControl->getStyle());
    }
}
