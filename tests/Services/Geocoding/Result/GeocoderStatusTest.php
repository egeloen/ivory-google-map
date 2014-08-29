<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding\Result;

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;

/**
 * Geocoder status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderStatusTest extends \PHPUnit_Framework_TestCase
{
    public function testGeocoderStatus()
    {
        $expected = array(
            GeocoderStatus::ERROR,
            GeocoderStatus::INVALID_REQUEST,
            GeocoderStatus::OK,
            GeocoderStatus::OVER_QUERY_LIMIT,
            GeocoderStatus::REQUEST_DENIED,
            GeocoderStatus::UNKNOWN_ERROR,
            GeocoderStatus::ZERO_RESULTS
        );

        $this->assertSame($expected, GeocoderStatus::getGeocoderStatus());
    }
}
