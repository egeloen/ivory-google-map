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
    public const STREET_ADDRESS = 'street_address';
    public const ROUTE = 'route';
    public const INTERSECTION = 'intersection';
    public const POLITICAL = 'political';
    public const COUNTRY = 'country';
    public const ADMINISTRATIVE_AREA_LEVEL_1 = 'administrative_area_level_1';
    public const ADMINISTRATIVE_AREA_LEVEL_2 = 'administrative_area_level_2';
    public const ADMINISTRATIVE_AREA_LEVEL_3 = 'administrative_area_level_3';
    public const ADMINISTRATIVE8AREA_LEVEL_4 = 'administrative_area_level_4';
    public const ADMINISTRATIVE8AREA_LEVEL_5 = 'administrative_area_level_5';
    public const COLLOQUIAL_AREA = 'colloquial_area';
    public const LOCALITY = 'locality';
    public const WARD = 'ward';
    public const SUB_LOCALITY = 'sublocality';
    public const NEIGHBORHOOD = 'neighborhood';
    public const PREMISE = 'premise';
    public const SUB_PREMISE = 'subpremise';
    public const POSTAL_CODE = 'postal_code';
    public const NATURAL_FEATURE = 'natural_feature';
    public const AIRPORT = 'airport';
    public const PARK = 'park';
    public const POINT_OF_INTEREST = 'point_of_interest';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
