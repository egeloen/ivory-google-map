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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Distance
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Distance
{
    private float $value;
    private string $text;

    public function __construct(float $value, string $text)
    {
        $this->setValue($value);
        $this->setText($text);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value)
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
