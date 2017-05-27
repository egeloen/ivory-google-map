<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitLine
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $shortName;

    /**
     * @var string|null
     */
    private $color;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string|null
     */
    private $textColor;

    /**
     * @var DirectionTransitVehicle|null
     */
    private $vehicle;

    /**
     * @var DirectionTransitAgency[]
     */
    private $agencies = [];

    /**
     * @return bool
     */
    public function hasName()
    {
        return $this->name !== null;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function hasShortName()
    {
        return $this->shortName !== null;
    }

    /**
     * @return string|null
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return bool
     */
    public function hasColor()
    {
        return $this->color !== null;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return bool
     */
    public function hasUrl()
    {
        return $this->url !== null;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function hasIcon()
    {
        return $this->icon !== null;
    }

    /**
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return bool
     */
    public function hasTextColor()
    {
        return $this->textColor !== null;
    }

    /**
     * @return string|null
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param string|null $textColor
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return bool
     */
    public function hasVehicle()
    {
        return $this->vehicle !== null;
    }

    /**
     * @return DirectionTransitVehicle|null
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param DirectionTransitVehicle|null $vehicle
     */
    public function setVehicle(DirectionTransitVehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return bool
     */
    public function hasAgencies()
    {
        return !empty($this->agencies);
    }

    /**
     * @return DirectionTransitAgency[]
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     */
    public function setAgencies(array $agencies)
    {
        $this->agencies = $agencies;
        $this->addAgencies($agencies);
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     */
    public function addAgencies(array $agencies)
    {
        foreach ($agencies as $agency) {
            $this->addAgency($agency);
        }
    }

    /**
     * @param DirectionTransitAgency $agency
     *
     * @return bool
     */
    public function hasAgency(DirectionTransitAgency $agency)
    {
        return in_array($agency, $this->agencies, true);
    }

    /**
     * @param DirectionTransitAgency $agency
     */
    public function addAgency(DirectionTransitAgency $agency)
    {
        if (!$this->hasAgency($agency)) {
            $this->agencies[] = $agency;
        }
    }

    /**
     * @param DirectionTransitAgency $agency
     */
    public function removeAgency(DirectionTransitAgency $agency)
    {
        unset($this->agencies[array_search($agency, $this->agencies, true)]);
        $this->agencies = empty($this->agencies) ? [] : array_values($this->agencies);
    }
}
