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
     * @var string
     */
    private $text;

    /**
     * @var float
     */
    private $value;

    /**
     * @param string $text
     * @param float  $value
     */
    public function __construct($text, $value)
    {
        $this->setText($text);
        $this->setValue($value);
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
}
