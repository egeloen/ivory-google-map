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

use Ivory\GoogleMap\Service\Base\Time;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Time
     */
    private $time;

    /**
     * @var \DateTime
     */
    private $value;

    /**
     * @var string
     */
    private $timeZone;

    /**
     * @var string
     */
    private $text;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->time = new Time(
            $this->value = new \DateTime(),
            $this->timeZone = 'Europe/Paris',
            $this->text = 'text'
        );
    }

    public function testDefaultState()
    {
        $this->assertSame($this->value, $this->time->getValue());
        $this->assertSame($this->timeZone, $this->time->getTimeZone());
        $this->assertSame($this->text, $this->time->getText());
    }

    public function testValue()
    {
        $this->time->setValue($value = new \DateTime());

        $this->assertSame($value, $this->time->getValue());
    }

    public function testTimeZone()
    {
        $this->time->setTimeZone($timeZone = 'Europe/Berlin');

        $this->assertSame($timeZone, $this->time->getTimeZone());
    }

    public function testText()
    {
        $this->time->setText($text = 'foo');

        $this->assertSame($text, $this->time->getText());
    }
}
