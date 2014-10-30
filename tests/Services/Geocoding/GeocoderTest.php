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

use Ivory\GoogleMap\Services\Geocoding\Geocoder;

/**
 * Geocoder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Geocoder */
    private $geocoder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoder = new Geocoder();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoder);
    }

    public function testGeocodeWithGeocoderProvider()
    {
        $this->geocoder->registerProvider($provider = $this->createGoogleMapsProviderMock());

        $provider
            ->expects($this->any())
            ->method('getGeocodedData')
            ->with($this->identicalTo($request = 'foo'))
            ->will($this->returnValue(array(array('bar'))));

        $this->assertGeocodedInstance($this->geocoder->geocode($request));
    }

    public function testGeocodeWithIvoryProvider()
    {
        $this->geocoder->registerProvider($provider = $this->createGeocoderProviderMock());

        $provider
            ->expects($this->any())
            ->method('getGeocodedData')
            ->with($this->identicalTo($request = $this->createGeocoderRequestMock()))
            ->will($this->returnValue($response = 'foo'));

        $this->assertSame($response, $this->geocoder->geocode($request));
    }

    public function testReverseWithGeocoderProvider()
    {
        $this->geocoder->registerProvider($provider = $this->createGoogleMapsProviderMock());

        $provider
            ->expects($this->any())
            ->method('getReversedData')
            ->with($this->identicalTo(array($longitude = 48.856633, $latitude = 2.352254)))
            ->will($this->returnValue(array(array('foo'))));

        $this->assertGeocodedInstance($this->geocoder->reverse($longitude, $latitude));
    }

    public function testReverseWithIvoryProvider()
    {
        $this->geocoder->registerProvider($provider = $this->createGeocoderProviderMock());

        $provider
            ->expects($this->any())
            ->method('getReversedData')
            ->with($this->identicalTo(array($longitude = 48.856633, $latitude = 2.352254)))
            ->will($this->returnValue($response = 'foo'));

        $this->assertSame($response, $this->geocoder->reverse($longitude, $latitude));
    }

    /**
     * {@inheritdoc}
     */
    protected function createGeocoderProviderMock()
    {
        $provider = parent::createGeocoderProviderMock();
        $provider
            ->expects($this->any())
            ->method('setMaxResults')
            ->with($this->anything())
            ->will($this->returnSelf());

        $provider
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('ivory'));

        return $provider;
    }

    /**
     * Asserts a geocoder geocoded instance.
     *
     * @param \Geocoder\Result\Geocoded $geocoded The geocoded.
     */
    private function assertGeocodedInstance($geocoded)
    {
        $this->assertInstanceOf('Geocoder\Result\Geocoded', $geocoded);
    }

    /**
     * Creates a geocoder google maps provider mock.
     *
     * @return \Geocoder\Provider\GoogleMapsProvider|\PHPUnit_Framework_MockObject_MockObject The google maps provider mock.
     */
    private function createGoogleMapsProviderMock()
    {
        $provider = $this->getMockBuilder('Geocoder\Provider\GoogleMapsProvider')
            ->disableOriginalConstructor()
            ->getMock();

        $provider
            ->expects($this->any())
            ->method('setMaxResults')
            ->with($this->anything())
            ->will($this->returnSelf());

        $provider
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('geocoder'));

        return $provider;
    }
}
