<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Base;

use Ivory\GoogleMap\Services\Base\TravelMode;

/**
 * Travel mode test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelModeTest extends \PHPUnit_Framework_TestCase
{
    public function testTravelModes()
    {
        $expected = array(
            TravelMode::BICYCLING,
            TravelMode::DRIVING,
            TravelMode::WALKING,
            TravelMode::TRANSIT,
        );

        $this->assertSame($expected, TravelMode::getTravelModes());
    }
}
