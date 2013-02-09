<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Animation;

/**
 * Animation test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationTest extends \PHPUnit_Framework_TestCase
{
    public function testMapTypeControlStyles()
    {
        $expected = array(
            Animation::BOUNCE,
            Animation::DROP,
        );

        $this->assertSame($expected, Animation::getAnimations());
    }
}
