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
 * @author GeLo <geloen.eric@gmail.com>
 */
class Fare
{
    private ?float $value = null;

    private ?string $currency = null;

    private ?string $text = null;

    /**
     * @param float  $value
     * @param string $currency
     * @param string $text
     */
    public function __construct($value, $currency, $text)
    {
        $this->setValue($value);
        $this->setCurrency($currency);
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

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
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
