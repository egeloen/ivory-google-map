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
    private array $elements = [];

    public function hasElements(): bool
    {
        return !empty($this->elements);
    }

    /**
     * @return DistanceMatrixElement[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param DistanceMatrixElement[] $elements
     */
    public function setElements(array $elements): void
    {
        $this->elements = [];
        $this->addElements($elements);
    }

    /**
     * @param DistanceMatrixElement[] $elements
     */
    public function addElements(array $elements): void
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    public function hasElement(DistanceMatrixElement $element): bool
    {
        return in_array($element, $this->elements, true);
    }

    public function addElement(DistanceMatrixElement $element): void
    {
        if (!$this->hasElement($element)) {
            $this->elements[] = $element;
        }
    }

    public function removeElement(DistanceMatrixElement $element): void
    {
        unset($this->elements[array_search($element, $this->elements, true)]);
        $this->elements = empty($this->elements) ? [] : array_values($this->elements);
    }
}
