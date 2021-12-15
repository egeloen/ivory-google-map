<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AddressComponent
{
    private ?string $longName = null;

    private ?string $shortName = null;

    /**
     * @var string[]
     */
    private array $types = [];

    public function hasLongName(): bool
    {
        return $this->longName !== null;
    }

    public function getLongName(): ?string
    {
        return $this->longName;
    }

    /**
     * @param string|null $longName
     */
    public function setLongName($longName = null): void
    {
        $this->longName = $longName;
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
    public function setShortName($shortName = null): void
    {
        $this->shortName = $shortName;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     */
    public function hasType($type): bool
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }
}
