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

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderLocationType;

/**
 * Geocoder location type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderLocationTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGeocoderLocationtypes()
    {
        $expected = array(
            GeocoderLocationType::APPROXIMATE,
            GeocoderLocationType::GEOMETRIC_CENTER,
            GeocoderLocationType::RANGE_INTERPOLATED,
            GeocoderLocationType::ROOFTOP,
        );

        $this->assertSame($expected, GeocoderLocationType::getGeocoderLocationTypes());
    }
}
