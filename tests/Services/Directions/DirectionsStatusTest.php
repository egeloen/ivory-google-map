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
class DirectionsStatusTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Services\Directions\DirectionsStatus');
    }

    public function testConstants()
    {
        $this->assertSame('INVALID_REQUEST', DirectionsStatus::INVALID_REQUEST);
        $this->assertSame('MAX_WAYPOINTS_EXCEEDED', DirectionsStatus::MAX_WAYPOINTS_EXCEEDED);
        $this->assertSame('NOT_FOUND', DirectionsStatus::NOT_FOUND);
        $this->assertSame('OK', DirectionsStatus::OK);
        $this->assertSame('OVER_QUERY_LIMIT', DirectionsStatus::OVER_QUERY_LIMIT);
        $this->assertSame('REQUEST_DENIED', DirectionsStatus::REQUEST_DENIED);
        $this->assertSame('UNKNOWN_ERROR', DirectionsStatus::UNKNOWN_ERROR);
        $this->assertSame('ZERO_RESULTS', DirectionsStatus::ZERO_RESULTS);
    }
}
