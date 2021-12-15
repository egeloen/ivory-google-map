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
class DirectionTransitVehicle
{
    private ?string $name = null;

    private ?string $icon = null;

    private ?string $type = null;

    private ?string $localIcon = null;

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

    public function hasType(): bool
    {
        return $this->type !== null;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function hasLocalIcon(): bool
    {
        return $this->localIcon !== null;
    }

    public function getLocalIcon(): ?string
    {
        return $this->localIcon;
    }

    /**
     * @param string|null $localIcon
     */
    public function setLocalIcon($localIcon): void
    {
        $this->localIcon = $localIcon;
    }
}
