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
    private ?float $value = null;

    private ?string $text = null;

    /**
     * @param float  $value
     * @param string $text
     */
    public function __construct($value, $text)
    {
        $this->setValue($value);
        $this->setText($text);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}
