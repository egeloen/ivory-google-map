<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base\Location;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceIdLocation implements LocationInterface
{
    private ?string $placeId = null;

    /**
     * @param string $placeId
     */
    public function __construct($placeId)
    {
        $this->setPlaceId($placeId);
    }

    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     */
    public function setPlaceId($placeId): void
    {
        $this->placeId = $placeId;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): string
    {
        return 'place_id:'.$this->placeId;
    }
}
