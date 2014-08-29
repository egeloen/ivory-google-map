<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

use Geocoder\Geocoder as BaseGeocoder;

/**
 * Geocoder which describes a google map geocoder.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Geocoder
 * @author GeLo <geloen.eric@gmail.com>
 */
class Geocoder extends BaseGeocoder
{
    /**
     * {@inheritdoc}
     */
    public function geocode($request)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            return $this->getProvider()->getGeocodedData($request);
        }

        return parent::geocode($request);
    }

    /**
     * {@inheritdoc}
     */
    public function reverse($latitude, $longitude)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            return $this->getProvider()->getReversedData(array($latitude, $longitude));
        }

        return parent::reverse($latitude, $longitude);
    }
}
