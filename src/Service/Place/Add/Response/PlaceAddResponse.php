<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Add\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Add\Request\PlaceAddRequestInterface;

/**
 * @author TeLiXj <telixj@gmail.com>
 */
class PlaceAddResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var PlaceAddRequestInterface|null
     */
    private $request;

    /**
     * @var string
     */
    private $placeId;

    /**
     * @var string
     */
    private $scope;

    /**
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function hasRequest()
    {
        return $this->request !== null;
    }

    /**
     * @return PlaceAddRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PlaceAddRequestInterface|null $request
     */
    public function setRequest(PlaceAddRequestInterface $request = null)
    {
        $this->request = $request;
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
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
}
