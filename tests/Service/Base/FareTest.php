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
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->fare = new Fare();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->fare->hasCurrency());
        $this->assertNull($this->fare->getCurrency());
        $this->assertFalse($this->fare->hasValue());
        $this->assertNull($this->fare->getValue());
        $this->assertFalse($this->fare->hasText());
        $this->assertNull($this->fare->getText());
    }

    public function testCurrency()
    {
        $this->fare->setCurrency($currency = 'EUR');

        $this->assertTrue($this->fare->hasCurrency());
        $this->assertSame($currency, $this->fare->getCurrency());
    }

    public function testValue()
    {
        $this->fare->setValue($value = 123.45);

        $this->assertTrue($this->fare->hasValue());
        $this->assertSame($value, $this->fare->getValue());
    }

    public function testText()
    {
        $this->fare->setText($text = 'text');

        $this->assertTrue($this->fare->hasText());
        $this->assertSame($text, $this->fare->getText());
    }
}
