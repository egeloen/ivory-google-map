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
     * @var string|null
     */
    private $currency;

    /**
     * @var float|null
     */
    private $value;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @return bool
     */
    public function hasCurrency()
    {
        return $this->currency !== null;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return bool
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * @return float|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float|null $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function hasText()
    {
        return $this->text !== null;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}
