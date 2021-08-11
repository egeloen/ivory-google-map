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
    private ?string $name = null;

    private ?string $shortName = null;

    private ?string $color = null;

    private ?string $url = null;

    private ?string $icon = null;

    private ?string $textColor = null;

    private ?DirectionTransitVehicle $vehicle = null;

    /**
     * @var DirectionTransitAgency[]
     */
    private array $agencies = [];

    public function hasName(): bool
    {
        return $this->name !== null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function hasShortName(): bool
    {
        return $this->shortName !== null;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     */
    public function setShortName($shortName): void
    {
        $this->shortName = $shortName;
    }

    public function hasColor(): bool
    {
        return $this->color !== null;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    public function hasUrl(): bool
    {
        return $this->url !== null;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function hasTextColor(): bool
    {
        return $this->textColor !== null;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    /**
     * @param string|null $textColor
     */
    public function setTextColor($textColor): void
    {
        $this->textColor = $textColor;
    }

    public function hasVehicle(): bool
    {
        return $this->vehicle !== null;
    }

    public function getVehicle(): ?DirectionTransitVehicle
    {
        return $this->vehicle;
    }

    /**
     * @param DirectionTransitVehicle|null $vehicle
     */
    public function setVehicle(DirectionTransitVehicle $vehicle = null): void
    {
        $this->vehicle = $vehicle;
    }

    public function hasAgencies(): bool
    {
        return !empty($this->agencies);
    }

    /**
     * @return DirectionTransitAgency[]
     */
    public function getAgencies(): array
    {
        return $this->agencies;
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     */
    public function setAgencies(array $agencies): void
    {
        $this->agencies = $agencies;
        $this->addAgencies($agencies);
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     */
    public function addAgencies(array $agencies): void
    {
        foreach ($agencies as $agency) {
            $this->addAgency($agency);
        }
    }

    public function hasAgency(DirectionTransitAgency $agency): bool
    {
        return in_array($agency, $this->agencies, true);
    }

    public function addAgency(DirectionTransitAgency $agency): void
    {
        if (!$this->hasAgency($agency)) {
            $this->agencies[] = $agency;
        }
    }

    public function removeAgency(DirectionTransitAgency $agency): void
    {
        unset($this->agencies[array_search($agency, $this->agencies, true)]);
        $this->agencies = empty($this->agencies) ? [] : array_values($this->agencies);
    }
}
