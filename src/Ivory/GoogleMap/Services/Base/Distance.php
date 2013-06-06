<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Base;

use Ivory\GoogleMap\Exception\ServiceException;

/**
 * Distance which describes a google map distance.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Distance
 * @author GeLo <geloen.eric@gmail.com>
 */
class Distance
{
    /** @var string */
    protected $text;

    /** @var double */
    protected $value;

    /**
     * Creates a distance.
     *
     * @param string $text  The distance as text.
     * @param double $value The distance in meters.
     */
    public function __construct($text, $value)
    {
        $this->setText($text);
        $this->setValue($value);
    }

    /**
     * Gets the string representation of the distance value.
     *
     * @return string The distance as text.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the string representation of the distance value.
     *
     * @param string $text The distance as text.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the text is not valid.
     */
    public function setText($text)
    {
        if (!is_string($text)) {
            throw ServiceException::invalidDistanceText();
        }

        $this->text = $text;
    }

    /**
     * Gets the distance in meters.
     *
     * @return double The distance in meters.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the distance in meters.
     *
     * @param double $value The distance in meters.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the distance is not valid.
     */
    public function setValue($value)
    {
        if (!is_numeric($value)) {
            throw ServiceException::invalidDistanceValue();
        }

        $this->value = $value;
    }
}
