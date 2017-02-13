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
    /**
     * @var string|null
     */
    private $placeId;

    /**
     * @var string|null
     */
    private $scope;

    /**
     * @return bool
     */
    public function hasPlaceId()
    {
        return $this->placeId !== null;
    }

    /**
     * @return string|null
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * @return bool
     */
    public function hasScope()
    {
        return $this->scope !== null;
    }

    /**
     * @return string|null
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
}
