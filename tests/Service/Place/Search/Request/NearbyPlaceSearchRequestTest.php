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
use Ivory\GoogleMap\Service\Place\Search\Request\NearbyPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class NearbyPlaceSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NearbyPlaceSearchRequest
     */
    private $request;

    /**
     * @var Coordinate|\PHPUnit_Framework_MockObject_MockObject
     */
    private $location;

    /**
     * @var string
     */
    private $rankBy;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new NearbyPlaceSearchRequest(
            $this->location = $this->createCoordinateMock(),
            $this->rankBy = PlaceSearchRankBy::PROMINENCE
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
        $this->assertSame($this->rankBy, $this->request->getRankBy());
    }

    public function testRankBy()
    {
        $this->request->setRankBy($rankBy = PlaceSearchRankBy::DISTANCE);

        $this->assertSame($rankBy, $this->request->getRankBy());
    }

    public function testBuildContext()
    {
        $this->assertSame('nearbysearch', $this->request->buildContext());
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
            'rankby'   => $this->rankBy,
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
