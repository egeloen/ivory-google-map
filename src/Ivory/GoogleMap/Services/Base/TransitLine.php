<?php

namespace Ivory\GoogleMap\Services\Base;

class TransitLine
{
    /** @var  TransitAgency[] */
    protected $agencies;
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $shortName;
    /** @var  string */
    protected $url;
    /** @var  TransitVehicle */
    protected $vehicle;

    public function __construct(array $agencies, $name, $shortName, $url, \stdClass $vehicle)
    {
        $this->agencies = array();
        foreach ($agencies as $agency) {
            $agencyName = isset($agency->name) ? $agency->name : null;
            $agencyPhone = isset($agency->phone) ? $agency->phone : null;
            $agencyUrl = isset($agency->url) ? $agency->url : null;
            $this->agencies[] = new TransitAgency($agencyName, $agencyPhone, $agencyUrl);
        }
        $this->name = $name;
        $this->shortName = $shortName;
        $this->url = $url;
        $this->vehicle = new TransitVehicle($vehicle->icon, $vehicle->name, $vehicle->type);

    }

    /**
     * @return TransitAgency[]
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

    /**
     * @param TransitAgency[] $agencies
     */
    public function setAgencies($agencies)
    {
        $this->agencies = $agencies;
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

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return TransitVehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param TransitVehicle $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }
} 
