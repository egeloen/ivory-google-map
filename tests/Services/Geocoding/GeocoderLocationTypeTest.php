<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Services\Geocoding\GeocoderLocationType;

/**
 * Geocoder location type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderLocationTypeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Services\Geocoding\GeocoderLocationType');
    }

    public function testConstants()
    {
        $this->assertSame('APPROXIMATE', GeocoderLocationType::APPROXIMATE);
        $this->assertSame('GEOMETRIC_CENTER', GeocoderLocationType::GEOMETRIC_CENTER);
        $this->assertSame('RANGE_INTERPOLATED', GeocoderLocationType::RANGE_INTERPOLATED);
        $this->assertSame('ROOFTOP', GeocoderLocationType::ROOFTOP);
    }
}
