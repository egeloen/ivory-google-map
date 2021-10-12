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
class GeocoderCoordinateRequest extends AbstractGeocoderReverseRequest
{
    private ?Coordinate $coordinate = null;

    public function __construct(Coordinate $coordinate)
    {
        $this->setCoordinate($coordinate);
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function setCoordinate(Coordinate $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): array
    {
        return array_merge(['latlng' => $this->buildCoordinate($this->coordinate)], parent::buildQuery());
    }
}
