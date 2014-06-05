<?php

namespace Ivory\GoogleMap\Services\Base;

class TransitVehicle
{
    /** @var string */
    protected $icon;
    /** @var string */
    protected $name;
    /** @var string */
    protected $type;

    public function __construct($icon, $name, $type)
    {
        $this->icon = $icon;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
