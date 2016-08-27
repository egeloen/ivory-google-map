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
    /**
     * @var string|null
     */
    private $longName;

    /**
     * @var string|null
     */
    private $shortName;

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @return bool
     */
    public function hasLongName()
    {
        return $this->longName !== null;
    }

    /**
     * @return string|null
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * @param string|null $longName
     */
    public function setLongName($longName = null)
    {
        $this->longName = $longName;
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
    public function setShortName($shortName = null)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return bool
     */
    public function hasTypes()
    {
        return !empty($this->types);
    }

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types)
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /**
     * @param string[] $types
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType($type)
    {
        return in_array($type, $this->types, true);
    }

    /**
     * @param string $type
     */
    public function addType($type)
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    /**
     * @param string $type
     */
    public function removeType($type)
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = array_values($this->types);
    }
}
