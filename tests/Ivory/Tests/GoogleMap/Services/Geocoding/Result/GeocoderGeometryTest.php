<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding\Result;

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderLocationType;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry;

/**
 * Geocoder geometry test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderGeometry */
    protected $geocoderGeometry;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $location;

    /** @var string */
    protected $locationType;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $viewport;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->location = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->locationType = GeocoderLocationType::RANGE_INTERPOLATED;
        $this->viewport = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->bound = $this->getMock('Ivory\GoogleMap\Base\Bound');

        $this->geocoderGeometry = new GeocoderGeometry(
            $this->location,
            $this->locationType,
            $this->viewport,
            $this->bound
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
        $this->assertSame($this->bound, $this->geocoderGeometry->getBound());
    }

    public function testLocation()
    {
        $location = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->geocoderGeometry->setLocation($location);

        $this->assertSame($location, $this->geocoderGeometry->getLocation());
    }

    public function testLocationTypeWithValidValue()
    {
        $this->geocoderGeometry->setLocationType(GeocoderLocationType::GEOMETRIC_CENTER);

        $this->assertSame(GeocoderLocationType::GEOMETRIC_CENTER, $this->geocoderGeometry->getLocationType());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder geometry location type can only be : APPROXIMATE, GEOMETRIC_CENTER,
     * RANGE_INTERPOLATED, ROOFTOP.
     */
    public function testLocationTypeWithInvalidValue()
    {
        $this->geocoderGeometry->setLocationType('foo');
    }

    public function testViewport()
    {
        $viewport = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->geocoderGeometry->setViewport($viewport);

        $this->assertSame($viewport, $this->geocoderGeometry->getViewport());
    }

    public function testBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->geocoderGeometry->setBound($bound);

        $this->assertSame($bound, $this->geocoderGeometry->getBound());
    }
}
