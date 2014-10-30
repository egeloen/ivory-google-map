<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Base;

use Ivory\GoogleMap\Services\Base\Duration;
use Ivory\Tests\GoogleMap\Services\AbstractTestCase;

/**
 * Duration test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DurationTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Base\Duration */
    private $duration;

    /** @var string */
    private $text;

    /** @var float */
    private $value;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->duration = new Duration($this->text = 'foo', $this->value = 2.2);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->value);
        unset($this->text);
        unset($this->duration);
    }

    public function testInitialState()
    {
        $this->assertSame($this->text, $this->duration->getText());
        $this->assertSame($this->value, $this->duration->getValue());
    }

    public function testSetText()
    {
        $this->duration->setText($text = 'bar');

        $this->assertSame($text, $this->duration->getText());
    }

    public function testSetValue()
    {
        $this->duration->setValue($value = 1.1);

        $this->assertSame($value, $this->duration->getValue());
    }
}
