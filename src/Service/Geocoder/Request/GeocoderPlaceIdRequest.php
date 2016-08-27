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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderPlaceIdRequest extends AbstractGeocoderReverseRequest
{
    /**
     * @var string
     */
    private $placeId;

    /**
     * @param string $placeId
     */
    public function __construct($placeId)
    {
        $this->setPlaceId($placeId);
    }

    /**
     * @return string
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        return array_merge(['place_id' => $this->placeId], parent::buildQuery());
    }
}
