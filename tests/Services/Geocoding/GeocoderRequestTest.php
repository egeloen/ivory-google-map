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

use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

/**
 * Geocoder request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderRequest */
    private $geocoderRequest;

    /** @var string|\Ivory\GoogleMap\Base\Coordinate|\PHPUnit_Framework_MockObject_MockObject */
    private $location;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequest = new GeocoderRequest($this->location = 'foo');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->location);
        unset($this->geocoderRequest);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->location, $this->geocoderRequest->getLocation());
        $this->assertFalse($this->geocoderRequest->hasBound());
        $this->assertFalse($this->geocoderRequest->hasRegion());
        $this->assertFalse($this->geocoderRequest->hasLanguage());
        $this->assertFalse($this->geocoderRequest->hasSensor());
    }

    public function testSetLocation()
    {
        $this->geocoderRequest->setLocation($location = $this->createCoordinateMock());

        $this->assertSame($location, $this->geocoderRequest->getLocation());
    }

    public function testSetBound()
    {
        $this->geocoderRequest->setBound($bound = $this->createBoundMock());

        $this->assertTrue($this->geocoderRequest->hasBound());
        $this->assertSame($bound, $this->geocoderRequest->getBound());
    }

    public function testResetBound()
    {
        $this->geocoderRequest->setBound($this->createBoundMock());
        $this->geocoderRequest->setBound(null);

        $this->assertFalse($this->geocoderRequest->hasBound());
        $this->assertNull($this->geocoderRequest->getBound());
    }

    public function testSetRegion()
    {
        $this->geocoderRequest->setRegion($region = 'fr');

        $this->assertTrue($this->geocoderRequest->hasRegion());
        $this->assertSame($region, $this->geocoderRequest->getRegion());
    }

    public function testResetRegion()
    {
        $this->geocoderRequest->setRegion('fr');
        $this->geocoderRequest->setRegion(null);

        $this->assertFalse($this->geocoderRequest->hasRegion());
        $this->assertNull($this->geocoderRequest->getRegion());
    }

    public function testSetLanguage()
    {
        $this->geocoderRequest->setLanguage($language = 'pl');

        $this->assertTrue($this->geocoderRequest->hasLanguage());
        $this->assertSame($language, $this->geocoderRequest->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->geocoderRequest->setLanguage('pl');
        $this->geocoderRequest->setLanguage(null);

        $this->assertFalse($this->geocoderRequest->hasLanguage());
        $this->assertNull($this->geocoderRequest->getLanguage());
    }

    public function testSetSensor()
    {
        $this->geocoderRequest->setSensor(true);

        $this->assertTrue($this->geocoderRequest->hasSensor());
    }
}
