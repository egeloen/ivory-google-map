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

use Ivory\GoogleMap\Base\Coordinate;

/**
 * Coordinate test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $coordinate;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinate = new Coordinate();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinate);
    }

    public function testDefaultState()
    {
        $this->assertSame('coordinate_', substr($this->coordinate->getJavascriptVariable(), 0, 11));
        $this->assertSame(0, $this->coordinate->getLatitude());
        $this->assertSame(0, $this->coordinate->getLongitude());
        $this->assertTrue($this->coordinate->isNoWrap());
    }

    public function testInitialState()
    {
        $this->coordinate = new Coordinate(1, 2, false);

        $this->assertSame(1, $this->coordinate->getLatitude());
        $this->assertSame(2, $this->coordinate->getLongitude());
        $this->assertFalse($this->coordinate->isNoWrap());
    }

    public function testLatitudeWithValidLatitude()
    {
        $this->coordinate->setLatitude(1);
        $this->assertSame(1, $this->coordinate->getLatitude());
    }

    public function testLatitudeWithNull()
    {
        $this->coordinate->setLatitude(null);
        $this->assertNull($this->coordinate->getLatitude());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The latitude of a coordinate must be a numeric value.
     */
    public function testLatitudeWithInvalidLatitude()
    {
        $this->coordinate->setLatitude(true);
    }

    public function testLongitudeWithValidLongitude()
    {
        $this->coordinate->setLongitude(1);
        $this->assertSame(1, $this->coordinate->getLongitude());
    }

    public function testLongitudeWithNull()
    {
        $this->coordinate->setLongitude(null);
        $this->assertNull($this->coordinate->getLongitude());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The longitude of a coordinate must be a numeric value.
     */
    public function testLongitudeWithInvalidLongitude()
    {
        $this->coordinate->setLongitude(true);
    }

    public function testNoWrapWithValidNoWrap()
    {
        $this->coordinate->setNoWrap(false);
        $this->assertFalse($this->coordinate->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\BaseException
     * @expectedExceptionMessage The no wrap coordinate property must be a boolean value.
     */
    public function testNoWrapWithInvalidNoWrap()
    {
        $this->coordinate->setNoWrap('foo');
    }
}
