<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionGeocoded
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var bool|null
     */
    private $partialMatch;

    /**
     * @var string|null
     */
    private $placeId;

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function hasPartialMatch()
    {
        return $this->partialMatch !== null;
    }

    /**
     * @return bool|null
     */
    public function isPartialMatch()
    {
        return $this->partialMatch;
    }

    /**
     * @param bool|null $partialMatch
     */
    public function setPartialMatch($partialMatch)
    {
        $this->partialMatch = $partialMatch;
    }

    /**
     * @return bool
     */
    public function hasPlaceId()
    {
        return $this->placeId !== null;
    }

    /**
     * @return string|null
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
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
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }
}
