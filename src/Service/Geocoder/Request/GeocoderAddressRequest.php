<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Request;

use Ivory\GoogleMap\Base\Bound;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressRequest extends AbstractGeocoderRequest
{
    private ?string $address = null;

    /**
     * @var mixed[]
     */
    private array $components = [];

    private ?Bound $bound = null;

    private ?string $region = null;

    /**
     * @param string $address
     */
    public function __construct($address)
    {
        $this->setAddress($address);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function hasComponents(): bool
    {
        return !empty($this->components);
    }

    /**
     * @return mixed[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * @param mixed[] $components
     */
    public function setComponents(array $components): void
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param mixed[] $components
     */
    public function addComponents(array $components): void
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    /**
     * @param string $type
     */
    public function hasComponent($type): bool
    {
        return isset($this->components[$type]);
    }

    /**
     * @param string $type
     *
     * @return mixed
     */
    public function getComponent($type)
    {
        return $this->hasComponent($type) ? $this->components[$type] : null;
    }

    /**
     * @param string $type
     * @param mixed  $value
     */
    public function setComponent($type, $value): void
    {
        $this->components[$type] = $value;
    }

    /**
     * @param string $type
     */
    public function removeComponent($type): void
    {
        unset($this->components[$type]);
    }

    public function hasBound(): bool
    {
        return $this->bound !== null;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null): void
    {
        $this->bound = $bound;
    }

    public function hasRegion(): bool
    {
        return $this->region !== null;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion($region = null): void
    {
        $this->region = $region;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): array
    {
        $query = ['address' => $this->address];

        if ($this->hasComponents()) {
            $query['components'] = implode('|', array_map(fn($type, $value) => $type.':'.$value, array_keys($this->components), $this->components));
        }

        if ($this->hasBound()) {
            $query['bound'] = implode('|', [
                $this->buildCoordinate($this->bound->getSouthWest()),
                $this->buildCoordinate($this->bound->getNorthEast()),
            ]);
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        return array_merge($query, parent::buildQuery());
    }
}
