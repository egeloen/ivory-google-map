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

use Ivory\GoogleMap\Services\Geocoding\GeocoderStatus;

/**
 * Geocoder status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderStatusTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Services\Geocoding\GeocoderStatus');
    }

    public function testConstants()
    {
        $this->assertSame('ERROR', GeocoderStatus::ERROR);
        $this->assertSame('INVALID_REQUEST', GeocoderStatus::INVALID_REQUEST);
        $this->assertSame('OK', GeocoderStatus::OK);
        $this->assertSame('OVER_QUERY_LIMIT', GeocoderStatus::OVER_QUERY_LIMIT);
        $this->assertSame('REQUEST_DENIED', GeocoderStatus::REQUEST_DENIED);
        $this->assertSame('UNKNOWN_ERROR', GeocoderStatus::UNKNOWN_ERROR);
        $this->assertSame('ZERO_RESULTS', GeocoderStatus::ZERO_RESULTS);
    }
}
