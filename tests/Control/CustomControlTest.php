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
use Ivory\GoogleMap\Control\CustomControl;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CustomControl
     */
    private $customControl;

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $control;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->customControl = new CustomControl(
            $this->position = ControlPosition::TOP_CENTER,
            $this->control = 'control'
        );
    }

    public function testDefaultState()
    {
        $this->assertSame($this->position, $this->customControl->getPosition());
        $this->assertSame($this->control, $this->customControl->getControl());
    }

    public function testPosition()
    {
        $this->customControl->setPosition($position = ControlPosition::BOTTOM_CENTER);

        $this->assertSame($position, $this->customControl->getPosition());
    }

    public function testControl()
    {
        $this->customControl->setControl($control = 'foo');

        $this->assertSame($control, $this->customControl->getControl());
    }
}
