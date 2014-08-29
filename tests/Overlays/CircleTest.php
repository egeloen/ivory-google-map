<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\Circle;

/**
 * Circle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Circle */
    protected $circle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circle = new Circle();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circle);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $this->circle->getCenter());
        $this->assertSame(1, $this->circle->getRadius());
    }

    public function testInitialState()
    {
        $center = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $radius = 2;

        $this->circle = new Circle($center, $radius);

        $this->assertSame($center, $this->circle->getCenter());
        $this->assertSame($radius, $this->circle->getRadius());
    }

    public function testCenterWithCoordinate()
    {
        $center = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->circle->setCenter($center);

        $this->assertSame($center, $this->circle->getCenter());
    }

    public function testCenterWithLatitudeAndLongitude()
    {
        $latitude = 1;
        $longitude = 2;

        $this->circle->setCenter($latitude, $longitude, true);

        $this->assertSame($latitude, $this->circle->getCenter()->getLatitude());
        $this->assertSame($longitude, $this->circle->getCenter()->getLongitude());
        $this->assertTrue($this->circle->getCenter()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage
     * The center setter arguments is invalid.
     * The available prototypes are :
     * - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     * - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testCenterWithInvalidValue()
    {
        $this->circle->setCenter('foo');
    }

    public function testRadiusWithValidValue()
    {
        $this->circle->setRadius(3);

        $this->assertSame(3, $this->circle->getRadius());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The radius of a circle must be a numeric value.
     */
    public function testRadiusWithInvalidValue()
    {
        $this->circle->setRadius(true);
    }
}
