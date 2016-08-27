<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Request\PositionalElevationRequest;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PositionalElevationRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PositionalElevationRequest
     */
    private $request;

    /**
     * @var LocationInterface[]|\PHPUnit_Framework_MockObject_MockObject[]
     */
    private $locations;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->locations = [$this->createLocationMock('first'), $this->createLocationMock('second')];

        $this->request = new PositionalElevationRequest($this->locations);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(ElevationRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->request->hasLocations());
        $this->assertSame($this->locations, $this->request->getLocations());
    }

    public function testSetLocations()
    {
        $this->request->setLocations($locations = [$location = $this->createLocationMock()]);
        $this->request->setLocations($locations);

        $this->assertTrue($this->request->hasLocations());
        $this->assertTrue($this->request->hasLocation($location));
        $this->assertSame($locations, $this->request->getLocations());
    }

    public function testAddLocations()
    {
        $this->request->setLocations($firstLocations = [$this->createLocationMock()]);
        $this->request->addLocations($secondLocations = [$this->createLocationMock()]);

        $this->assertTrue($this->request->hasLocations());
        $this->assertSame(array_merge($firstLocations, $secondLocations), $this->request->getLocations());
    }

    public function testAddLocation()
    {
        $this->request->addLocation($location = $this->createLocationMock());

        $this->assertTrue($this->request->hasLocations());
        $this->assertTrue($this->request->hasLocation($location));
        $this->assertSame(array_merge($this->locations, [$location]), $this->request->getLocations());
    }

    public function testRemoveLocation()
    {
        $this->request->addLocation($location = $this->createLocationMock());
        $this->request->removeLocation($location);

        $this->assertTrue($this->request->hasLocations());
        $this->assertFalse($this->request->hasLocation($location));
        $this->assertSame($this->locations, $this->request->getLocations());
    }

    public function testBuildQuery()
    {
        $this->assertSame(['locations' => 'first|second'], $this->request->buildQuery());
    }

    /**
     * @param string $value
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|LocationInterface
     */
    private function createLocationMock($value = 'value')
    {
        $location = $this->createMock(LocationInterface::class);
        $location
            ->expects($this->any())
            ->method('buildQuery')
            ->will($this->returnValue($value));

        return $location;
    }
}
