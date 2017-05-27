<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRow
{
    /**
     * @var DistanceMatrixElement[]
     */
    private $elements = [];

    /**
     * @return bool
     */
    public function hasElements()
    {
        return !empty($this->elements);
    }

    /**
     * @return DistanceMatrixElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param DistanceMatrixElement[] $elements
     */
    public function setElements(array $elements)
    {
        $this->elements = [];
        $this->addElements($elements);
    }

    /**
     * @param DistanceMatrixElement[] $elements
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * @param DistanceMatrixElement $element
     *
     * @return bool
     */
    public function hasElement(DistanceMatrixElement $element)
    {
        return in_array($element, $this->elements, true);
    }

    /**
     * @param DistanceMatrixElement $element
     */
    public function addElement(DistanceMatrixElement $element)
    {
        if (!$this->hasElement($element)) {
            $this->elements[] = $element;
        }
    }

    /**
     * @param DistanceMatrixElement $element
     */
    public function removeElement(DistanceMatrixElement $element)
    {
        unset($this->elements[array_search($element, $this->elements, true)]);
        $this->elements = empty($this->elements) ? [] : array_values($this->elements);
    }
}
