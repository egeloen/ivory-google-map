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

use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderStatus;

/**
 * Geocoder response test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResponse */
    protected $geocoderResponse;

    /** @var array */
    protected $results;

    /** @var string */
    protected $status;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $geocoderResult = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult')
            ->disableOriginalConstructor()
            ->getMock();

        $this->results = array($geocoderResult);
        $this->status = GeocoderStatus::REQUEST_DENIED;

        $this->geocoderResponse = new GeocoderResponse($this->results, $this->status);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderResponse);
        unset($this->results);
        unset($this->status);
    }

    public function testInitialState()
    {
        $this->assertSame($this->results, $this->geocoderResponse->getResults());
        $this->assertSame($this->status, $this->geocoderResponse->getStatus());
    }

    public function testResults()
    {
        $geocoderResult = $this->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult')
            ->disableOriginalConstructor()
            ->getMock();

        $results = array($geocoderResult);

        $this->geocoderResponse->setResults($results);

        $this->assertSame($results, $this->geocoderResponse->getResults());
    }

    public function testStatusWithValidValue()
    {
        $this->geocoderResponse->setStatus(GeocoderStatus::ERROR);

        $this->assertSame(GeocoderStatus::ERROR, $this->geocoderResponse->getStatus());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder response status can only be : ERROR, INVALID_REQUEST, OK,
     * OVER_QUERY_LIMIT, REQUEST_DENIED, UNKNOWN_ERROR, ZERO_RESULTS.
     */
    public function testStatusWithInvalidValue()
    {
        $this->geocoderResponse->setStatus('foo');
    }
}
