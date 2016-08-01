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
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Coordinate
     */
    private $coordinate;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinate = new Coordinate();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(VariableAwareInterface::class, $this->coordinate);
    }

    public function testDefaultState()
    {
        $this->assertStringStartsWith('coordinate', $this->coordinate->getVariable());
        $this->assertSame(0.0, $this->coordinate->getLatitude());
        $this->assertSame(0.0, $this->coordinate->getLongitude());
        $this->assertTrue($this->coordinate->isNoWrap());
    }

    public function testInitialState()
    {
        $this->coordinate = new Coordinate($latitude = 1.2, $longitude = 2.3, false);

        $this->assertStringStartsWith('coordinate', $this->coordinate->getVariable());
        $this->assertSame($latitude, $this->coordinate->getLatitude());
        $this->assertSame($longitude, $this->coordinate->getLongitude());
        $this->assertFalse($this->coordinate->isNoWrap());
    }

    public function testLatitude()
    {
        $this->coordinate->setLatitude($latitude = 1.2);

        $this->assertSame($latitude, $this->coordinate->getLatitude());
    }

    public function testLongitude()
    {
        $this->coordinate->setLongitude($longitude = 1.2);

        $this->assertSame($longitude, $this->coordinate->getLongitude());
    }

    public function testNoWrap()
    {
        $this->coordinate->setNoWrap(false);

        $this->assertFalse($this->coordinate->isNoWrap());
    }
}
