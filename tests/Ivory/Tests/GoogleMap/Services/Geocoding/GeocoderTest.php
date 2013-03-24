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

use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\GoogleMapsProvider;
use Ivory\GoogleMap\Services\Geocoding\Geocoder;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;

/**
 * Geocoder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Geocoder */
    protected $geocoder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoder = new Geocoder();
    }

    /**
     * Set up a geocoder provider.
     */
    protected function setUpGeocoderProvider()
    {
        $this->geocoder->registerProvider(new GoogleMapsProvider(new CurlHttpAdapter()));
    }

    /**
     * Set up the Ivory provider.
     */
    protected function setUpIvoryProvider()
    {
        $this->geocoder->registerProvider(new GeocoderProvider(new CurlHttpAdapter()));
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
        $this->setUpGeocoderProvider();

        $this->assertInstanceOf('Geocoder\Result\Geocoded', $this->geocoder->geocode('Paris'));
    }

    public function testGeocodeWithIvoryProvider()
    {
        $this->setUpIvoryProvider();

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse',
            $this->geocoder->geocode('Paris')
        );
    }

    public function testReverseWithGeocoderProvider()
    {
        $this->setUpGeocoderProvider();

        $this->assertInstanceOf('Geocoder\Result\Geocoded', $this->geocoder->reverse(48.856633, 2.352254));
    }

    public function testReverseWithIvoryProvider()
    {
        $this->setUpIvoryProvider();

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse',
            $this->geocoder->reverse(48.856633, 2.352254)
        );
    }
}
