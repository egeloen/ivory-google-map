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

use Ivory\GoogleMap\Services\Geocoding\GeocoderResponse;
use Ivory\GoogleMap\Services\Geocoding\GeocoderStatus;

/**
 * Geocoder response test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponseTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\GeocoderResponse */
    private $geocoderResponse;

    /** @var array */
    private $results;

    /** @var string */
    private $status;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderResponse = new GeocoderResponse(
            $this->results = array($this->createGeocoderResultMock()),
            $this->status = GeocoderStatus::REQUEST_DENIED
        );
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
        $this->assertTrue($this->geocoderResponse->hasResults());
        $this->assertSame($this->results, $this->geocoderResponse->getResults());
        $this->assertSame($this->status, $this->geocoderResponse->getStatus());
    }

    public function testSetResults()
    {
        $this->geocoderResponse->setResults($results = array($this->createGeocoderResultMock()));

        $this->assertResults($results);
    }

    public function testAddResults()
    {
        $this->geocoderResponse->setResults($results = array($this->createGeocoderResultMock()));
        $this->geocoderResponse->addResults($newResults = array($this->createGeocoderResultMock()));

        $this->assertResults(array_merge($results, $newResults));
    }

    public function testRemoveResults()
    {
        $this->geocoderResponse->setResults($results = array($this->createGeocoderResultMock()));
        $this->geocoderResponse->removeResults($results);

        $this->assertNoResults();
    }

    public function testResetResults()
    {
        $this->geocoderResponse->setResults(array($this->createGeocoderResultMock()));
        $this->geocoderResponse->resetResults();

        $this->assertNoResults();
    }

    public function testAddResult()
    {
        $this->geocoderResponse->addResult($result = $this->createGeocoderResultMock());

        $this->assertResult($result);
    }

    public function testAddResultUnicity()
    {
        $this->geocoderResponse->resetResults();
        $this->geocoderResponse->addResult($result = $this->createGeocoderResultMock());
        $this->geocoderResponse->addResult($result);

        $this->assertResults(array($result));
    }

    public function testRemoveResult()
    {
        $this->geocoderResponse->addResult($result = $this->createGeocoderResultMock());
        $this->geocoderResponse->removeResult($result);

        $this->assertNoResult($result);
    }

    public function testSetStatus()
    {
        $this->geocoderResponse->setStatus($status = GeocoderStatus::ERROR);

        $this->assertSame($status, $this->geocoderResponse->getStatus());
    }

    /**
     * Asserts there are results.
     *
     * @param array $results The results.
     */
    private function assertResults($results)
    {
        $this->assertInternalType('array', $results);

        $this->assertTrue($this->geocoderResponse->hasResults());
        $this->assertSame($results, $this->geocoderResponse->getResults());

        foreach ($results as $result) {
            $this->assertResult($result);
        }
    }

    /**
     * Asserts there is a result.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderResult $result The result.
     */
    private function assertResult($result)
    {
        $this->assertGeocoderResultInstance($result);
        $this->assertTrue($this->geocoderResponse->hasResult($result));
    }

    /**
     * Asserts there are no results.
     */
    private function assertNoResults()
    {
        $this->assertFalse($this->geocoderResponse->hasResults());
        $this->assertEmpty($this->geocoderResponse->getResults());
    }

    /**
     * Asserts there is no result.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderResult $result The result.
     */
    private function assertNoResult($result)
    {
        $this->assertGeocoderResultInstance($result);
        $this->assertFalse($this->geocoderResponse->hasResult($result));
    }
}
