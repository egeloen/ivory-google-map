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

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractGeocoderRequest implements GeocoderRequestInterface
{
    /**
     * @var string|null
     */
    private $language;

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = [];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    /**
     * @param Coordinate $place
     *
     * @return string
     */
    protected function buildCoordinate(Coordinate $place)
    {
        return $place->getLatitude().','.$place->getLongitude();
    }
}
