<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Point;

/**
 * Point test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Base\Point */
    protected $point;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->point = new Point();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->point);
    }

    public function testDefaultState()
    {
        $this->assertSame('point_', substr($this->point->getJavascriptVariable(), 0, 6));
        $this->assertSame(0, $this->point->getX());
        $this->assertSame(0, $this->point->getY());
    }

    public function testInitialState()
    {
        $this->point = new Point(1, 2);

        $this->assertSame(1, $this->point->getX());
        $this->assertSame(2, $this->point->getY());
    }

    public function testXWithValidValue()
    {
        $this->point->setX(1);

        $this->assertSame(1, $this->point->getX());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The x coordinate of a point must be a numeric value.
     */
    public function testXWithInvalidValue()
    {
        $this->point->setX(true);
    }

    public function testYWithValidValue()
    {
        $this->point->setY(1);

        $this->assertSame(1, $this->point->getY());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The y coordinate of a point must be a numeric value.
     */
    public function testYWithInvalidValue()
    {
        $this->point->setY(true);
    }
}
