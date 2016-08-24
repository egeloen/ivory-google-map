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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Distance
     */
    private $distance;

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
