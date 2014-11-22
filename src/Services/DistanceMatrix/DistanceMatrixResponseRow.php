<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

/**
 * Distance matrix response row.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixResponseRow
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponseRow
{
    /** @var array */
    private $elements;

    /**
     * Creates a distance matrix response row.
     *
     * @param array $elements The elements.
     */
    public function __construct(array $elements)
    {
        $this->setElements($elements);
    }

    /**
     * Resets the elements.
     */
    public function resetElements()
    {
        $this->elements = array();
    }

    /**
     * Checks if there are elements.
     *
     * @return boolean TRUE if there are elements else FALSE.
     */
    public function hasElements()
    {
        return !empty($this->elements);
    }

    /**
     * Gets the elements.
     *
     * @return array The elements.
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Sets the elements.
     *
     * @param array $elements The elements.
     */
    public function setElements(array $elements)
    {
        $this->resetElements();
        $this->addElements($elements);
    }

    /**
     * Adds the elements.
     *
     * @param array $elements The elements.
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * Removes the elements.
     *
     * @param array $elements The elements.
     */
    public function removeElements(array $elements)
    {
        foreach ($elements as $element) {
            $this->removeElement($element);
        }
    }

    /**
     * Checks if there is an element.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element.
     *
     * @return boolean TRUE if there is the element else FALSE.
     */
    public function hasElement(DistanceMatrixResponseElement $element)
    {
        return in_array($element, $this->elements, true);
    }

    /**
     * Adds an element.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element.
     */
    public function addElement(DistanceMatrixResponseElement $element)
    {
        if (!$this->hasElement($element)) {
            $this->elements[] = $element;
        }
    }

    /**
     * Removes an element.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element.
     */
    public function removeElement(DistanceMatrixResponseElement $element)
    {
        unset($this->elements[array_search($element, $this->elements, true)]);
    }
}
