<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Base;

use Ivory\GoogleMap\Service\Base\Fare;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class FareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Fare
     */
    private $fare;

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
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->fare = new Fare(
            $this->value = 123.4,
            $this->currency = 'EUR',
            $this->text = '123.4€'
        );
    }

    public function testDefaultState()
    {
        $this->assertSame($this->value, $this->fare->getValue());
        $this->assertSame($this->currency, $this->fare->getCurrency());
        $this->assertSame($this->text, $this->fare->getText());
    }

    public function testValue()
    {
        $this->fare->setValue($value = 123.45);

        $this->assertSame($value, $this->fare->getValue());
    }

    public function testCurrency()
    {
        $this->fare->setCurrency($currency = 'USD');

        $this->assertSame($currency, $this->fare->getCurrency());
    }

    public function testText()
    {
        $this->fare->setText($text = 'text');

        $this->assertSame($text, $this->fare->getText());
    }
}
