<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Services\Directions\DirectionsStatus;

/**
 * Directions status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStatusTest extends \PHPUnit_Framework_TestCase
{
    public function testDirectionsStatus()
    {
        $expected = array(
            DirectionsStatus::INVALID_REQUEST,
            DirectionsStatus::MAX_WAYPOINTS_EXCEEDED,
            DirectionsStatus::NOT_FOUND,
            DirectionsStatus::OK,
            DirectionsStatus::OVER_QUERY_LIMIT,
            DirectionsStatus::REQUEST_DENIED,
            DirectionsStatus::UNKNOWN_ERROR,
            DirectionsStatus::ZERO_RESULTS,
        );

        $this->assertSame($expected, DirectionsStatus::getDirectionsStatus());
    }
}
