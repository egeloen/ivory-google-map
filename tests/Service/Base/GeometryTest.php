<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Geocoder\GeocoderLocationType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeometryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Geometry
     */
    private $geometry;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geometry = new Geometry();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->geometry->hasLocation());
        $this->assertNull($this->geometry->getLocation());
        $this->assertFalse($this->geometry->hasLocationType());
        $this->assertNull($this->geometry->getLocationType());
        $this->assertFalse($this->geometry->hasViewport());
        $this->assertNull($this->geometry->getViewport());
        $this->assertFalse($this->geometry->hasBound());
        $this->assertNull($this->geometry->getBound());
    }

    public function testLocation()
    {
        $this->geometry->setLocation($location = $this->createCoordinateMock());

        $this->assertTrue($this->geometry->hasLocation());
        $this->assertSame($location, $this->geometry->getLocation());
    }

    public function testResetLocation()
    {
        $this->geometry->setLocation($this->createCoordinateMock());
        $this->geometry->setLocation(null);

        $this->assertFalse($this->geometry->hasLocation());
        $this->assertNull($this->geometry->getLocation());
    }

    public function testLocationType()
    {
        $this->geometry->setLocationType($locationType = GeocoderLocationType::GEOMETRIC_CENTER);

        $this->assertTrue($this->geometry->hasLocationType());
        $this->assertSame($locationType, $this->geometry->getLocationType());
    }

    public function testResetLocationType()
    {
        $this->geometry->setLocationType(GeocoderLocationType::GEOMETRIC_CENTER);
        $this->geometry->setLocationType(null);

        $this->assertFalse($this->geometry->hasLocationType());
        $this->assertNull($this->geometry->getLocationType());
    }

    public function testViewport()
    {
        $this->geometry->setViewport($viewport = $this->createBoundMock());

        $this->assertTrue($this->geometry->hasViewport());
        $this->assertSame($viewport, $this->geometry->getViewport());
    }

    public function testResetViewport()
    {
        $this->geometry->setViewport($this->createBoundMock());
        $this->geometry->setViewport(null);

        $this->assertFalse($this->geometry->hasViewport());
        $this->assertNull($this->geometry->getViewport());
    }

    public function testBound()
    {
        $this->geometry->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->geometry->hasBound());
        $this->assertSame($bound, $this->geometry->getBound());
    }

    public function testResetBound()
    {
        $this->geometry->setBound($this->createBoundMock());
        $this->geometry->setBound(null);

        $this->assertFalse($this->geometry->hasBound());
        $this->assertNull($this->geometry->getBound());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Coordinate
     */
    private function createCoordinateMock()
    {
        return $this->createMock(Coordinate::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Bound
     */
    private function createBoundMock()
    {
        return $this->createMock(Bound::class);
    }
}
