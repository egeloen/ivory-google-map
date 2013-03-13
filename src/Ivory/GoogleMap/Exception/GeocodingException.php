<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Exception;

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderLocationType,
    Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;

/**
 * Geocoding exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocodingException extends ServiceException
{
    /**
     * Gets the "INVALID GEOCODER ADDRESS COMPONENT LONG NAME" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER ADDRESS COMPONENT LONG NAME" exception.
     */
    static public function invalidGeocoderAddressComponentLongName()
    {
        return new static('The geocoder address component long name must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER ADDRESS COMPONENT SHORT NAME" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER ADDRESS COMPONENT SHORT NAME" exception.
     */
    static public function invalidGeocoderAddressComponentShortName()
    {
        return new static('The geocoder address component short name must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER ADDRESS COMPONENT TYPE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER ADDRESS COMPONENT TYPE" exception.
     */
    static public function invalidGeocoderAddressComponentType()
    {
        return new static('The geocoder address component type must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER LOCATION TYPE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER LOCATION TYPE" exception.
     */
    static public function invalidGeocoderLocationType()
    {
        return new static(sprintf(
            'The geocoder geometry location type can only be : %s.',
            implode(', ', GeocoderLocationType::getGeocoderLocationTypes())
        ));
    }

    /**
     * Gets the "INVALID GEOCODER PROVIDER FORMAT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER PROVIDER FORMAT" exception.
     */
    static public function invalidGeocoderProviderFormat()
    {
        return new static(sprintf('The geocoder provider format can only be : %s.', implode(', ', array('json', 'xml'))));
    }

    /**
     * Gets the "INVALID GEOCODER PROVIDER HTTPS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER PROVIDER HTTPS" exception.
     */
    static public function invalidGeocoderProviderHttps()
    {
        return new static('The geocoder provider https flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID GEOCODER PROVIDER REQUEST" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER PROVIDER REQUEST" exception.
     */
    static public function invalidGeocoderProviderRequest()
    {
        return new static('The geocoder request is not valid. It needs at least an address or a coordinate.');
    }

    /**
     * Gets the "INVALID GEOCODER PROVIDER REQUEST ARGUMENTS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER PROVIDER REQUEST ARGUMENTS" exception.
     */
    static public function invalidGeocoderProviderRequestArguments()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The geolocate argument is invalid.',
            'The available prototypes are :',
            ' - function geocode(string $address)',
            ' - function geocode(Ivory\GoogleMap\Services\Geocoding\GeocoderRequest $request)'
        ));
    }

    /**
     * Gets the "INVALID GEOCODER PROVIDER URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER PROVIDER URL" exception.
     */
    static public function invalidGeocoderProviderUrl()
    {
        return new static('The geocoder provider url must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST ADDRESS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST ADDRESS" exception.
     */
    static public function invalidGeocoderRequestAddress()
    {
        return new static('The geocoder request address must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST BOUND" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST BOUND" exception.
     */
    static public function invalidGeocoderRequestBound()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The bound setter arguments are invalid.',
            'The available prototypes are :',
            ' - function setBound(Ivory\GoogleMap\Base\Bound $bound = null)',
            ' - function setBound(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)',
            ' - function setBound(double $southWestLatitude, double $southWestLongitude, double $northEastLatitude, double $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)'
        ));
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST COORDINATE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST COORDINATE" exception.
     */
    static public function invalidGeocoderRequestCoordinate()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The coordinate setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setCoordinate(Ivory\GoogleMap\Base\Coordinate $coordinate = null)',
            ' - function setCoordinate(double $latitude, double $longitude, boolean $noWrap = true)'
        ));
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST REGION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST REGION" exception.
     */
    static public function invalidGeocoderRequestRegion()
    {
        return new static('The geocoder request region must be a string with two characters.');
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST LANGUAGE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST LANGUAGE" exception.
     */
    static public function invalidGeocoderRequestLanguage()
    {
        return new static('The geocoder request language must be a string with two characters.');
    }

    /**
     * Gets the "INVALID GEOCODER REQUEST SENSOR" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER REQUEST SENSOR" exception.
     */
    static public function invalidGeocoderRequestSensor()
    {
        return new static('The geocoder request sensor flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID GEOCODER RESPONSE STATUS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER RESPONSE STATUS" exception.
     */
    static public function invalidGeocoderResponseStatus()
    {
        return new static(sprintf('The geocoder response status can only be : %s.', implode(', ', GeocoderStatus::getGeocoderStatus())));
    }

    /**
     * Gets the "INVALID GEOCODER RESULT FORMATTED ADDRESS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER RESULT FORMATTED ADDRESS" exception.
     */
    static public function invalidGeocoderResultFormattedAddress()
    {
        return new static('The geocoder result formatted address must be a string value.');
    }

    /**
     * Gets the "INVALID GEOCODER RESULT PARTIAL MATCH" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER RESULT PARTIAL MATCH" exception.
     */
    static public function invalidGeocoderResultPartialMatch()
    {
        return new static('The geocoder result partial match flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID GEOCODER RESULT TYPE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\GeocodingException The "INVALID GEOCODER RESULT TYPE" exception.
     */
    static public function invalidGeocoderResultType()
    {
        return new static('The geocoder result type must be a string value.');
    }
}
