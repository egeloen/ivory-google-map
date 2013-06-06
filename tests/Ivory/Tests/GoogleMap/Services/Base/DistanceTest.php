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

/**
 * Distance test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Base\Distance */
    protected $distance;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distance = new Distance('foo', 2.2);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->distance);
    }

    public function testInitialState()
    {
        $this->assertSame('foo', $this->distance->getText());
        $this->assertSame(2.2, $this->distance->getValue());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The distance text must be a string value.
     */
    public function testTextWithInvalidValue()
    {
        $this->distance->setText(true);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The distance value must be a numeric value.
     */
    public function testValueWithInvalidValue()
    {
        $this->distance->setValue('foo');
    }
}
