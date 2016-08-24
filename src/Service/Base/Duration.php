<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Duration
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Duration
{
    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $text;

    /**
     * @param float  $value
     * @param string $text
     */
    public function __construct($value, $text)
    {
        $this->setValue($value);
        $this->setText($text);
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}
