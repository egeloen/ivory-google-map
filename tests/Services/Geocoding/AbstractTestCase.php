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

use Ivory\Tests\GoogleMap\Services\AbstractTestCase as TestCase;

/**
 * Geocoding test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a geocoder address component instance.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent $addressComponent The geocoder address component.
     */
    protected function assertGeocoderAddressComponentInstance($addressComponent)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent', $addressComponent);
    }

    /**
     * Asserts a geocoder result instance.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderResult $result The geocoder result.
     */
    protected function assertGeocoderResultInstance($result)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\GeocoderResult', $result);
    }

    /**
     * Creates a geocoder address component mock.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent|\PHPUnit_Framework_MockObject_MockObject The geocoder address component mock.
     */
    protected function createGeocoderAddressComponentMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\GeocoderAddressComponent')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a geocoder geometry mock.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry|\PHPUnit_Framework_MockObject_MockObject The geocoder geometry mock.
     */
    protected function createGeocoderGeometryMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\GeocoderGeometry')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a geocoder provider mock.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderProvider|\PHPUnit_Framework_MockObject_MockObject The geocoder provider mock.
     */
    protected function createGeocoderProviderMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\GeocoderProvider')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Creates a geocoder request mock.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderRequest|\PHPUnit_Framework_MockObject_MockObject The geocoder request mock.
     */
    protected function createGeocoderRequestMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\GeocoderRequest')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    /**
     * Creates a geocoder result mock.
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderResult|\PHPUnit_Framework_MockObject_MockObject The geocoder result mock.
     */
    protected function createGeocoderResultMock()
    {
        return $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\GeocoderResult')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
