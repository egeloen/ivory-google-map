<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;

/**
 * Distance matrix element status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsMatrixElementStatusTest extends \PHPUnit_Framework_TestCase
{
    public function testDistanceMatrixElementStatus()
    {
        $expected = array(
            DistanceMatrixElementStatus::NOT_FOUND,
            DistanceMatrixElementStatus::OK,
            DistanceMatrixElementStatus::ZERO_RESULTS,
        );

        $this->assertSame($expected, DistanceMatrixElementStatus::getDistanceMatrixElementStatus());
    }
}
