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
 * A duration which describes a google map duration.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Duration
 * @author GeLo <geloen.eric@gmail.com>
 */
class Duration
{
    /** @var string */
    protected $text;

    /** @var double */
    protected $value;

    /**
     * Creates a duration.
     *
     * @param string $text  The duration as text.
     * @param double $value The duration in minutes.
     */
    public function __construct($text, $value)
    {
        $this->setText($text);
        $this->setValue($value);
    }

    /**
     * Gets the string representation of the duration value.
     *
     * @return string The duration as text.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the string representation of the duration value
     *
     * @param string $text The duration as text.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the text is not valid.
     */
    public function setText($text)
    {
        if (!is_string($text)) {
            throw ServiceException::invalidDurationText();
        }

        $this->text = $text;
    }

    /**
     * Gets the duration in minutes
     *
     * @return double The duration in minutes.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the duration in minutes
     *
     * @param double $value The duration in minutes.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the value is not valid.
     */
    public function setValue($value)
    {
        if (!is_numeric($value)) {
            throw ServiceException::invalidDurationValue();
        }

        $this->value = $value;
    }
}
