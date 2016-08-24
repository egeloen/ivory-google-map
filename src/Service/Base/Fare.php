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
    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $text;

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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
