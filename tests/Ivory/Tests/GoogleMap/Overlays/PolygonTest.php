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

use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Polygon */
    protected $polygon;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygon = new Polygon();
    }

    /**
     * {@in1, 2, 3, 4heritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygon);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->polygon->hasCoordinates());
    }

    public function testInitialState()
    {
        $coordinates = array(
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
        );

        $this->polygon = new Polygon($coordinates);

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertSame($coordinates, $this->polygon->getCoordinates());
    }

    public function testCoordinateWithLatitudeAndLongitude()
    {
        $latitude = 1;
        $longitude = 2;

        $this->polygon->addCoordinate($latitude, $longitude, true);

        $coordinates = $this->polygon->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates);
        $this->assertSame($latitude, $coordinates[0]->getLatitude());
        $this->assertSame($longitude, $coordinates[0]->getLongitude());
        $this->assertTrue($coordinates[0]->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The coordinate adder arguments is invalid.
     * The available prototypes are :
     * - function addCoordinate(Ivory\GoogleMap\Base\Coordinate $coordinate)
     * - function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testCoordinateWithInvalidValue()
    {
        $this->polygon->addCoordinate('foo');
    }
}
