<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Service;

use Ivory\GoogleMap\Services\Base\Distance;
use Ivory\Tests\GoogleMap\Services\AbstractTestCase;

/**
 * Distance test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    private $distance;

    /** @var string */
    private $text;

    /** @var float */
    private $value;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distance = new Distance($this->text = 'foo', $this->value = 2.2);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->value);
        unset($this->text);
        unset($this->distance);
    }

    public function testInitialState()
    {
        $this->assertSame($this->text, $this->distance->getText());
        $this->assertSame($this->value, $this->distance->getValue());
    }

    public function testSetText()
    {
        $this->distance->setText($text = 'bar');

        $this->assertSame($text, $this->distance->getText());
    }

    public function testSetValue()
    {
        $this->distance->setValue($value = 1.1);

        $this->assertSame($value, $this->distance->getValue());
    }
}
