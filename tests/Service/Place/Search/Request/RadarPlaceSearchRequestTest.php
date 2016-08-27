<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Search\Request\AbstractTextualPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\RadarPlaceSearchRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RadarPlaceSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RadarPlaceSearchRequest
     */
    private $request;

    /**
     * @var Coordinate|\PHPUnit_Framework_MockObject_MockObject
     */
    private $location;

    /**
     * @var float
     */
    private $radius;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new RadarPlaceSearchRequest(
            $this->location = $this->createCoordinateMock(),
            $this->radius = 123.4
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractTextualPlaceSearchRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->request->hasLocation());
        $this->assertSame($this->location, $this->request->getLocation());
        $this->assertTrue($this->request->hasRadius());
        $this->assertSame($this->radius, $this->request->getRadius());
    }

    public function testBuildContext()
    {
        $this->assertSame('radarsearch', $this->request->buildContext());
    }

    public function testBuildQuery()
    {
        $this->location
            ->expects($this->once())
            ->method('getLatitude')
            ->will($this->returnValue(1.23));

        $this->location
            ->expects($this->once())
            ->method('getLongitude')
            ->will($this->returnValue(3.21));

        $this->assertSame([
            'location' => '1.23,3.21',
            'radius'   => $this->radius,
        ], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }
}
