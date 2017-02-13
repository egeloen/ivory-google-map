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
    /**
     * @var string
     */
    private $address;

    /**
     * @var mixed[]
     */
    private $components = [];

    /**
     * @var Bound|null
     */
    private $bound;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @param string $address
     */
    public function __construct($address)
    {
        $this->setAddress($address);
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return bool
     */
    public function hasComponents()
    {
        return !empty($this->components);
    }

    /**
     * @return mixed[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param mixed[] $components
     */
    public function setComponents(array $components)
    {
        $this->components = [];
        $this->addComponents($components);
    }

    /**
     * @param mixed[] $components
     */
    public function addComponents(array $components)
    {
        foreach ($components as $type => $value) {
            $this->setComponent($type, $value);
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasComponent($type)
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
    public function setComponent($type, $value)
    {
        $this->components[$type] = $value;
    }

    /**
     * @param string $type
     */
    public function removeComponent($type)
    {
        unset($this->components[$type]);
    }

    /**
     * @return bool
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * @param Bound|null $bound
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }

    /**
     * @return bool
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = ['address' => $this->address];

        if ($this->hasComponents()) {
            $query['components'] = implode('|', array_map(function ($type, $value) {
                return $type.':'.$value;
            }, array_keys($this->components), $this->components));
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
