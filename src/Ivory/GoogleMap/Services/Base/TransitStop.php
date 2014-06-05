<?php

namespace Ivory\GoogleMap\Services\Base;

use Ivory\GoogleMap\Base\Coordinate;

class TransitStop
{
    /** @var Coordinate */
    protected $location;
    /** @var  string */
    protected $name;

    public function __construct($lat, $lng, $name)
    {
        $this->location = new Coordinate($lat, $lng);
        $this->name = $name;
    }

    /**
     * @return Coordinate
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
