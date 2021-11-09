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

use Ivory\GoogleMap\Service\Base\Distance;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceTest extends TestCase
{
    private Distance $distance;

    private ?float $value = null;

    private ?string $text = null;

    protected function setUp(): void
    {
        $this->distance = new Distance($this->value = 2.3, $this->text = 'foo');
    }

    public function testInitialState()
    {
        $this->assertSame($this->value, $this->distance->getValue());
        $this->assertSame($this->text, $this->distance->getText());
    }

    public function testValue()
    {
        $this->distance->setValue($value = 3.2);

        $this->assertSame($value, $this->distance->getValue());
    }

    public function testText()
    {
        $this->distance->setText($text = 'bar');

        $this->assertSame($text, $this->distance->getText());
    }
}
