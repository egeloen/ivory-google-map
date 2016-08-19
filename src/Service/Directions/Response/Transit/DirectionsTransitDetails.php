<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Directions\Response\Transit;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsTransitDetails
{
    /**
     * @var DirectionsTransitStop|null
     */
    private $departureStop;

    /**
     * @var DirectionsTransitStop|null
     */
    private $arrivalStop;

    /**
     * @var \DateTime|null
     */
    private $departureTime;

    /**
     * @var \DateTime|null
     */
    private $arrivalTime;

    /**
     * @var string|null
     */
    private $headSign;

    /**
     * @var int|null
     */
    private $headWay;

    /**
     * @var DirectionsTransitLine|null
     */
    private $line;

    /**
     * @var int|null
     */
    private $numStops;

    /**
     * @return bool
     */
    public function hasDepartureStop()
    {
        return $this->departureStop !== null;
    }

    /**
     * @return DirectionsTransitStop|null
     */
    public function getDepartureStop()
    {
        return $this->departureStop;
    }

    /**
     * @param DirectionsTransitStop|null $departureStop
     */
    public function setDepartureStop(DirectionsTransitStop $departureStop = null)
    {
        $this->departureStop = $departureStop;
    }

    /**
     * @return bool
     */
    public function hasArrivalStop()
    {
        return $this->arrivalStop !== null;
    }

    /**
     * @return DirectionsTransitStop|null
     */
    public function getArrivalStop()
    {
        return $this->arrivalStop;
    }

    /**
     * @param DirectionsTransitStop|null $arrivalStop
     */
    public function setArrivalStop(DirectionsTransitStop $arrivalStop = null)
    {
        $this->arrivalStop = $arrivalStop;
    }

    /**
     * @return bool
     */
    public function hasDepartureTime()
    {
        return $this->departureTime !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param \DateTime|null $departureTime
     */
    public function setDepartureTime(\DateTime $departureTime = null)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return bool
     */
    public function hasArrivalTime()
    {
        return $this->arrivalTime !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param \DateTime|null $arrivalTime
     */
    public function setArrivalTime(\DateTime $arrivalTime = null)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return bool
     */
    public function hasHeadSign()
    {
        return $this->headSign !== null;
    }

    /**
     * @return string|null
     */
    public function getHeadSign()
    {
        return $this->headSign;
    }

    /**
     * @param string|null $headSign
     */
    public function setHeadSign($headSign)
    {
        $this->headSign = $headSign;
    }

    /**
     * @return bool
     */
    public function hasHeadWay()
    {
        return $this->headWay !== null;
    }

    /**
     * @return int|null
     */
    public function getHeadWay()
    {
        return $this->headWay;
    }

    /**
     * @param int|null $headWay
     */
    public function setHeadWay($headWay)
    {
        $this->headWay = $headWay;
    }

    /**
     * @return bool
     */
    public function hasLine()
    {
        return $this->line !== null;
    }

    /**
     * @return DirectionsTransitLine|null
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param DirectionsTransitLine|null $line
     */
    public function setLine(DirectionsTransitLine $line = null)
    {
        $this->line = $line;
    }

    /**
     * @return bool
     */
    public function hasNumStops()
    {
        return $this->numStops !== null;
    }

    /**
     * @return int|null
     */
    public function getNumStops()
    {
        return $this->numStops;
    }

    /**
     * @param int|null $numStops
     */
    public function setNumStops($numStops)
    {
        $this->numStops = $numStops;
    }
}
