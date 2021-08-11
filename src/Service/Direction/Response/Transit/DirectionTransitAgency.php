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
class DirectionTransitAgency
{
    private ?string $name = null;

    private ?string $phone = null;

    private ?string $url = null;

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

    public function hasPhone(): bool
    {
        return $this->phone !== null;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
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
}
