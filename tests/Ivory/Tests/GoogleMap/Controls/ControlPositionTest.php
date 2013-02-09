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

/**
 * Control position test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionTest extends \PHPUnit_Framework_TestCase
{
    public function testControlPositions()
    {
        $expected = array(
            ControlPosition::BOTTOM_CENTER,
            ControlPosition::BOTTOM_LEFT,
            ControlPosition::BOTTOM_RIGHT,
            ControlPosition::LEFT_BOTTOM,
            ControlPosition::LEFT_CENTER,
            ControlPosition::LEFT_TOP,
            ControlPosition::RIGHT_BOTTOM,
            ControlPosition::RIGHT_CENTER,
            ControlPosition::RIGHT_TOP,
            ControlPosition::TOP_CENTER,
            ControlPosition::TOP_LEFT,
            ControlPosition::TOP_RIGHT
        );

        $this->assertSame($expected, ControlPosition::getControlPositions());
    }
}
