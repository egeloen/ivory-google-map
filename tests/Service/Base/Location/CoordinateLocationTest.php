<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Service\Base\Location;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateLocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CoordinateLocation
     */
    private $coordinateLocation;

    /**
     * @var Coordinate|\PHPUnit_Framework_MockObject_MockObject
     */
    private $coordinate;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinate = $this->createCoordinateMock();
        $this->coordinateLocation = new CoordinateLocation($this->coordinate);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(LocationInterface::class, $this->coordinateLocation);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->coordinate, $this->coordinateLocation->getCoordinate());
    }

    public function testCoordinate()
    {
        $this->coordinateLocation->setCoordinate($coordinate = $this->createCoordinateMock());

        $this->assertSame($coordinate, $this->coordinateLocation->getCoordinate());
    }

    public function testBuildQuery()
    {
        $this->coordinate
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue(1.2));

        $this->coordinate
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue(2.3));

        $this->assertSame('1.2,2.3', $this->coordinateLocation->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
