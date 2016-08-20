<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class DirectionGeocodedType
{
    const STREET_ADDRESS = 'street_address';
    const ROUTE = 'route';
    const INTERSECTION = 'intersection';
    const POLITICAL = 'political';
    const COUNTRY = 'country';
    const ADMINISTRATIVE_AREA_LEVEL_1 = 'administrative_area_level_1';
    const ADMINISTRATIVE_AREA_LEVEL_2 = 'administrative_area_level_2';
    const ADMINISTRATIVE_AREA_LEVEL_3 = 'administrative_area_level_3';
    const ADMINISTRATIVE8AREA_LEVEL_4 = 'administrative_area_level_4';
    const ADMINISTRATIVE8AREA_LEVEL_5 = 'administrative_area_level_5';
    const COLLOQUIAL_AREA = 'colloquial_area';
    const LOCALITY = 'locality';
    const WARD = 'ward';
    const SUB_LOCALITY = 'sublocality';
    const NEIGHBORHOOD = 'neighborhood';
    const PREMISE = 'premise';
    const SUB_PREMISE = 'subpremise';
    const POSTAL_CODE = 'postal_code';
    const NATURAL_FEATURE = 'natural_feature';
    const AIRPORT = 'airport';
    const PARK = 'park';
    const POINT_OF_INTEREST = 'point_of_interest';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
