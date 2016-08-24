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

use Ivory\GoogleMap\Service\Base\Duration;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Duration
     */
    private $duration;

    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $text;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->duration = new Duration($this->value = 2.3, $this->text = 'foo');
    }

    public function testInitialState()
    {
        $this->assertSame($this->value, $this->duration->getValue());
        $this->assertSame($this->text, $this->duration->getText());
    }

    public function testValue()
    {
        $this->duration->setValue($value = 3.2);

        $this->assertSame($value, $this->duration->getValue());
    }

    public function testText()
    {
        $this->duration->setText($text = 'bar');

        $this->assertSame($text, $this->duration->getText());
    }
}
