<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Services\Geocoding\GeocoderLocationType;
use Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry;

/**
 * Geocoder geometry test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometryTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry */
    private $geocoderGeometry;

    /** @var \Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $location;

    /** @var string */
    private $locationType;

    /** @var \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject */
    private $viewport;

    /** @var \Ivory\GoogleMap\Base\Bound|\PHPUnit_Framework_MockObject_MockObject */
    private $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderGeometry = new GeocoderGeometry(
            $this->location = $this->createCoordinateMock(),
            $this->locationType = GeocoderLocationType::RANGE_INTERPOLATED,
            $this->viewport = $this->createBoundMock(),
            $this->bound = $this->createBoundMock()
        );
    }

    protected function tearDown()
    {
        unset($this->geocoderGeometry);
        unset($this->location);
        unset($this->locationType);
        unset($this->viewport);
        unset($this->bound);
    }

    public function testInitialState()
    {
        $this->assertSame($this->location, $this->geocoderGeometry->getLocation());
        $this->assertSame($this->locationType, $this->geocoderGeometry->getLocationType());
        $this->assertSame($this->viewport, $this->geocoderGeometry->getViewport());

        $this->assertTrue($this->geocoderGeometry->hasBound());
        $this->assertSame($this->bound, $this->geocoderGeometry->getBound());
    }

    public function testSetLocation()
    {
        $this->geocoderGeometry->setLocation($location = $this->createCoordinateMock());

        $this->assertSame($location, $this->geocoderGeometry->getLocation());
    }

    public function testSetLocationType()
    {
        $this->geocoderGeometry->setLocationType($locationType = GeocoderLocationType::GEOMETRIC_CENTER);

        $this->assertSame($locationType, $this->geocoderGeometry->getLocationType());
    }

    public function testSetViewport()
    {
        $this->geocoderGeometry->setViewport($viewport = $this->createBoundMock());

        $this->assertSame($viewport, $this->geocoderGeometry->getViewport());
    }

    public function testSetBound()
    {
        $this->geocoderGeometry->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->geocoderGeometry->hasBound());
        $this->assertSame($bound, $this->geocoderGeometry->getBound());
    }

    public function testResetBound()
    {
        $this->geocoderGeometry->setBound($this->createBoundMock());
        $this->geocoderGeometry->setBound(null);

        $this->assertFalse($this->geocoderGeometry->hasBound());
        $this->assertNull($this->geocoderGeometry->getBound());
    }
}
