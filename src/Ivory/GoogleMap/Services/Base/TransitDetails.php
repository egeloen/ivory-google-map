<?php

namespace Ivory\GoogleMap\Services\Base;

class TransitDetails
{
    protected $arrivalStop;
    protected $arrivalTime;
    protected $departureStop;
    protected $departureTime;
    protected $headsign;
    protected $headway;
    protected $line;
    protected $numStops;

    public function __construct(\stdClass $transitDetails)
    {
        $this->arrivalStop = new TransitStop(
            $transitDetails->arrival_stop->location->lat,
            $transitDetails->arrival_stop->location->lng,
            $transitDetails->arrival_stop->name
        );
        $this->arrivalTime = new TransitTime(
            $transitDetails->arrival_time->text,
            $transitDetails->arrival_time->time_zone,
            $transitDetails->arrival_time->value
        );
        $this->departureStop = new TransitStop(
            $transitDetails->departure_stop->location->lat,
            $transitDetails->departure_stop->location->lng,
            $transitDetails->departure_stop->name
        );
        $this->departureTime = new TransitTime(
            $transitDetails->departure_time->text,
            $transitDetails->departure_time->time_zone,
            $transitDetails->departure_time->value
        );
        $this->headsign = $transitDetails->headsign;
        if (isset($transitDetails->headway)) {
            $this->headway = $transitDetails->headway;
        }
        $agencies = $transitDetails->line->agencies;
        $name = $transitDetails->line->name;
        $shortName = $transitDetails->line->short_name;
        $url = isset($transitDetails->line->url) ? $transitDetails->line->url : null;
        $vehicle = $transitDetails->line->vehicle;
        $this->line = new TransitLine(
            $agencies,
            $name,
            $shortName,
            $url,
            $vehicle
        );
        $this->numStops = $transitDetails->num_stops;
    }

    /**
     * @return TransitStop
     */
    public function getArrivalStop()
    {
        return $this->arrivalStop;
    }

    /**
     * @param TransitStop $arrivalStop
     */
    public function setArrivalStop($arrivalStop)
    {
        $this->arrivalStop = $arrivalStop;
    }

    /**
     * @return TransitTime
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param TransitTime $arrivalTime
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return TransitStop
     */
    public function getDepartureStop()
    {
        return $this->departureStop;
    }

    /**
     * @param TransitStop $departureStop
     */
    public function setDepartureStop($departureStop)
    {
        $this->departureStop = $departureStop;
    }

    /**
     * @return TransitTime
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param TransitTime $departureTime
     */
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return mixed
     */
    public function getHeadsign()
    {
        return $this->headsign;
    }

    /**
     * @param mixed $headsign
     */
    public function setHeadsign($headsign)
    {
        $this->headsign = $headsign;
    }

    /**
     * @return mixed
     */
    public function getHeadway()
    {
        return $this->headway;
    }

    /**
     * @param mixed $headway
     */
    public function setHeadway($headway)
    {
        $this->headway = $headway;
    }

    /**
     * @return TransitLine
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param TransitLine $line
     */
    public function setLine($line)
    {
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getNumStops()
    {
        return $this->numStops;
    }

    /**
     * @param mixed $numStops
     */
    public function setNumStops($numStops)
    {
        $this->numStops = $numStops;
    }

}
