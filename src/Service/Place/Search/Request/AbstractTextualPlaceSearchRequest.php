<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTextualPlaceSearchRequest extends AbstractPlaceSearchRequest
{
    /**
     * @var string|null
     */
    private $keyword;

    /**
     * @var string[]
     */
    private $names = [];

    /**
     * @return bool
     */
    public function hasKeyword()
    {
        return $this->keyword !== null;
    }

    /**
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return bool
     */
    public function hasNames()
    {
        return !empty($this->names);
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param string[] $names
     */
    public function setNames(array $names)
    {
        $this->names = [];
        $this->addNames($names);
    }

    /**
     * @param string[] $names
     */
    public function addNames(array $names)
    {
        foreach ($names as $name) {
            $this->addName($name);
        }
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasName($name)
    {
        return in_array($name, $this->names, true);
    }

    /**
     * @param string $name
     */
    public function addName($name)
    {
        if (!$this->hasName($name)) {
            $this->names[] = $name;
        }
    }

    /**
     * @param string $name
     */
    public function removeName($name)
    {
        unset($this->names[array_search($name, $this->names, true)]);
        $this->names = array_values($this->names);
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = parent::buildQuery();

        if ($this->hasKeyword()) {
            $query['keyword'] = $this->keyword;
        }

        if ($this->hasNames()) {
            $query['name'] = implode('|', $this->names);
        }

        return $query;
    }
}
