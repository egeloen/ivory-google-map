<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompletePrediction
{
    /**
     * @var string|null
     */
    private $placeId;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string[]
     */
    private $types = [];

    /**
     * @var PlaceAutocompleteTerm[]
     */
    private $terms = [];

    /**
     * @var PlaceAutocompleteMatch[]
     */
    private $matches = [];

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
    public function hasDescription()
    {
        return $this->description !== null;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

    /**
     * @return bool
     */
    public function hasTerms()
    {
        return !empty($this->terms);
    }

    /**
     * @return PlaceAutocompleteTerm[]
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param PlaceAutocompleteTerm[] $terms
     */
    public function setTerms(array $terms)
    {
        $this->terms = [];
        $this->addTerms($terms);
    }

    /**
     * @param PlaceAutocompleteTerm[] $terms
     */
    public function addTerms(array $terms)
    {
        foreach ($terms as $term) {
            $this->addTerm($term);
        }
    }

    /**
     * @param PlaceAutocompleteTerm $term
     *
     * @return bool
     */
    public function hasTerm(PlaceAutocompleteTerm $term)
    {
        return in_array($term, $this->terms, true);
    }

    /**
     * @param PlaceAutocompleteTerm $term
     */
    public function addTerm(PlaceAutocompleteTerm $term)
    {
        if (!$this->hasTerm($term)) {
            $this->terms[] = $term;
        }
    }

    /**
     * @param PlaceAutocompleteTerm $term
     */
    public function removeTerm(PlaceAutocompleteTerm $term)
    {
        unset($this->terms[array_search($term, $this->terms, true)]);
        $this->terms = array_values($this->terms);
    }

    /**
     * @return bool
     */
    public function hasMatches()
    {
        return !empty($this->matches);
    }

    /**
     * @return PlaceAutocompleteMatch[]
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param PlaceAutocompleteMatch[] $matches
     */
    public function setMatches(array $matches)
    {
        $this->matches = [];
        $this->addMatches($matches);
    }

    /**
     * @param PlaceAutocompleteMatch[] $matches
     */
    public function addMatches(array $matches)
    {
        foreach ($matches as $match) {
            $this->addMatch($match);
        }
    }

    /**
     * @param PlaceAutocompleteMatch $match
     *
     * @return bool
     */
    public function hasMatch(PlaceAutocompleteMatch $match)
    {
        return in_array($match, $this->matches, true);
    }

    /**
     * @param PlaceAutocompleteMatch $match
     */
    public function addMatch(PlaceAutocompleteMatch $match)
    {
        if (!$this->hasMatch($match)) {
            $this->matches[] = $match;
        }
    }

    /**
     * @param PlaceAutocompleteMatch $match
     */
    public function removeMatch(PlaceAutocompleteMatch $match)
    {
        unset($this->matches[array_search($match, $this->matches, true)]);
        $this->matches = array_values($this->matches);
    }
}
