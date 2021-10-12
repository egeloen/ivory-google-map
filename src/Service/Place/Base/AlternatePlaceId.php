<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AlternatePlaceId
{
    private ?string $placeId = null;

    private ?string $scope = null;

    public function hasPlaceId(): bool
    {
        return $this->placeId !== null;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId): void
    {
        $this->placeId = $placeId;
    }

    public function hasScope(): bool
    {
        return $this->scope !== null;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     */
    public function setScope($scope): void
    {
        $this->scope = $scope;
    }
}
