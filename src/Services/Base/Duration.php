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

/**
 * Duration.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Duration
 * @author GeLo <geloen.eric@gmail.com>
 */
class Duration
{
    /** @var string */
    private $text;

    /** @var float */
    private $value;

    /**
     * Creates a duration.
     *
     * @param string $text  The text.
     * @param float  $value The value.
     */
    public function __construct($text, $value)
    {
        $this->setText($text);
        $this->setValue($value);
    }

    /**
     * Gets the text.
     *
     * @return string The text.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text.
     *
     * @param string $text The text.
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Gets the value.
     *
     * @return float The value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @param float $value The value.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
