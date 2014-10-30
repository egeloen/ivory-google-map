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
class ControlPositionTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Controls\ControlPosition');
    }

    public function testConstants()
    {
        $this->assertSame('bottom_center', ControlPosition::BOTTOM_CENTER);
        $this->assertSame('bottom_left', ControlPosition::BOTTOM_LEFT);
        $this->assertSame('bottom_right', ControlPosition::BOTTOM_RIGHT);
        $this->assertSame('left_bottom', ControlPosition::LEFT_BOTTOM);
        $this->assertSame('left_center', ControlPosition::LEFT_CENTER);
        $this->assertSame('left_top', ControlPosition::LEFT_TOP);
        $this->assertSame('right_bottom', ControlPosition::RIGHT_BOTTOM);
        $this->assertSame('right_center', ControlPosition::RIGHT_CENTER);
        $this->assertSame('right_top', ControlPosition::RIGHT_TOP);
        $this->assertSame('top_center', ControlPosition::TOP_CENTER);
        $this->assertSame('top_left', ControlPosition::TOP_LEFT);
        $this->assertSame('top_right', ControlPosition::TOP_RIGHT);
    }
}
