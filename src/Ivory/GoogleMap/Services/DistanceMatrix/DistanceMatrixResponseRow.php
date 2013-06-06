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
 * A distance matrix response wraps the distance results & the response status.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixResponseRow
{
    /** @var array */
    protected $elements;

    /**
     * Create a distance matrix response row.
     *
     * @param array $elements The row elements.
     */
    public function __construct(array $elements)
    {
        $this->setElements($elements);
    }

    /**
     * Gets the distance matrix row elements.
     *
     * @return array The row elements.
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Sets the distance matrix row elements.
     *
     * @param array $elements The row elements.
     */
    public function setElements(array $elements)
    {
        $this->elements = array();

        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * Add a distance matrix element.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement $element The element to add.
     */
    public function addElement(DistanceMatrixResponseElement $element)
    {
        $this->elements[] = $element;
    }
}
