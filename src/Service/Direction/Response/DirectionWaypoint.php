<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypoint
{
    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @var int|null
     */
    private $stepIndex;

    /**
     * @var float|null
     */
    private $stepInterpolation;

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return $this->location !== null;
    }

    /**
     * @return Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Coordinate $location
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function hasStepIndex()
    {
        return $this->stepIndex !== null;
    }

    /**
     * @return int|null
     */
    public function getStepIndex()
    {
        return $this->stepIndex;
    }

    /**
     * @param int|null $stepIndex
     */
    public function setStepIndex($stepIndex)
    {
        $this->stepIndex = $stepIndex;
    }

    /**
     * @return bool
     */
    public function hasStepInterpolation()
    {
        return $this->stepInterpolation !== null;
    }

    /**
     * @return float|null
     */
    public function getStepInterpolation()
    {
        return $this->stepInterpolation;
    }

    /**
     * @param float|null $stepInterpolation
     */
    public function setStepInterpolation($stepInterpolation)
    {
        $this->stepInterpolation = $stepInterpolation;
    }
}
