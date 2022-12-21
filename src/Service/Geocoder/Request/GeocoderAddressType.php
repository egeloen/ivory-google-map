<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class GeocoderAddressType
{
    public const STREET_ADDRESS = 'street_address';
    public const ROUTE = 'route';
    public const INTERSECTION = 'intersection';
    public const POLITICAL = 'political';
    public const COUNTRY = 'country';
    public const ADMINISTRATIVE_AREA_LEVEL_1 = 'administrative_area_level_1';
    public const ADMINISTRATIVE_AREA_LEVEL_2 = 'administrative_area_level_2';
    public const ADMINISTRATIVE_AREA_LEVEL_3 = 'administrative_area_level_3';
    public const ADMINISTRATIVE_AREA_LEVEL_4 = 'administrative_area_level_4';
    public const ADMINISTRATIVE_AREA_LEVEL_5 = 'administrative_area_level_5';
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
    public const FLOOR = 'floor';
    public const ESTABLISHMENT = 'establishment';
    public const PARKING = 'parking';
    public const POST_BOX = 'post_box';
    public const POSTAL_TOWN = 'postal_town';
    public const ROOM = 'room';
    public const STREET_NUMBER = 'street_number';
    public const BUS_STATION = 'bus_station';
    public const TRAIN_STATiON = 'train_station';
    public const TRANSIT_STATION = 'transit_station';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
