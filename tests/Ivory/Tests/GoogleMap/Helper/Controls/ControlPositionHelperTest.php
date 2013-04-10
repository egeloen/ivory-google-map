<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Helper\Controls\ControlPositionHelper;

/**
 * Control position helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controlPositionHelper = new ControlPositionHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->controlPositionHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame(
            'google.maps.ControlPosition.BOTTOM_CENTER',
            $this->controlPositionHelper->render(ControlPosition::BOTTOM_CENTER)
        );

        $this->assertSame(
            'google.maps.ControlPosition.BOTTOM_LEFT',
            $this->controlPositionHelper->render(ControlPosition::BOTTOM_LEFT)
        );

        $this->assertSame(
            'google.maps.ControlPosition.BOTTOM_RIGHT',
            $this->controlPositionHelper->render(ControlPosition::BOTTOM_RIGHT)
        );

        $this->assertSame(
            'google.maps.ControlPosition.LEFT_BOTTOM',
            $this->controlPositionHelper->render(ControlPosition::LEFT_BOTTOM)
        );

        $this->assertSame(
            'google.maps.ControlPosition.LEFT_CENTER',
            $this->controlPositionHelper->render(ControlPosition::LEFT_CENTER)
        );

        $this->assertSame(
            'google.maps.ControlPosition.LEFT_TOP',
            $this->controlPositionHelper->render(ControlPosition::LEFT_TOP)
        );

        $this->assertSame(
            'google.maps.ControlPosition.RIGHT_BOTTOM',
            $this->controlPositionHelper->render(ControlPosition::RIGHT_BOTTOM)
        );

        $this->assertSame(
            'google.maps.ControlPosition.RIGHT_CENTER',
            $this->controlPositionHelper->render(ControlPosition::RIGHT_CENTER)
        );

        $this->assertSame(
            'google.maps.ControlPosition.RIGHT_TOP',
            $this->controlPositionHelper->render(ControlPosition::RIGHT_TOP)
        );

        $this->assertSame(
            'google.maps.ControlPosition.TOP_CENTER',
            $this->controlPositionHelper->render(ControlPosition::TOP_CENTER)
        );

        $this->assertSame(
            'google.maps.ControlPosition.TOP_LEFT',
            $this->controlPositionHelper->render(ControlPosition::TOP_LEFT)
        );

        $this->assertSame(
            'google.maps.ControlPosition.TOP_RIGHT',
            $this->controlPositionHelper->render(ControlPosition::TOP_RIGHT)
        );
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The control position can only be : bottom_center, bottom_left, bottom_right,
     * left_bottom, left_center, left_top, right_bottom, right_center, right_top, top_center, top_left, top_right.
     */
    public function testRenderWithInvalidValue()
    {
        $this->controlPositionHelper->render('foo');
    }
}
