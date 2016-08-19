<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder\Response;

use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResponse;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResult;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GeocoderResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new GeocoderResponse();
    }

    public function testInitialState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasResults());
        $this->assertEmpty($this->response->getResults());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = GeocoderStatus::ERROR);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testResetStatus()
    {
        $this->response->setStatus(GeocoderStatus::ERROR);
        $this->response->setStatus(null);

        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
    }

    public function testSetResults()
    {
        $this->response->setResults($results = [$result = $this->createResultMock()]);
        $this->response->setResults($results);

        $this->assertTrue($this->response->hasResults());
        $this->assertTrue($this->response->hasResult($result));
        $this->assertSame($results, $this->response->getResults());
    }

    public function testAddResults()
    {
        $this->response->setResults($firstResults = [$this->createResultMock()]);
        $this->response->addResults($secondResults = [$this->createResultMock()]);

        $this->assertTrue($this->response->hasResults());
        $this->assertSame(array_merge($firstResults, $secondResults), $this->response->getResults());
    }

    public function testAddResult()
    {
        $this->response->addResult($result = $this->createResultMock());

        $this->assertTrue($this->response->hasResults());
        $this->assertTrue($this->response->hasResult($result));
        $this->assertSame([$result], $this->response->getResults());
    }

    public function testRemoveResult()
    {
        $this->response->addResult($result = $this->createResultMock());
        $this->response->removeResult($result);

        $this->assertFalse($this->response->hasResults());
        $this->assertFalse($this->response->hasResult($result));
        $this->assertEmpty($this->response->getResults());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GeocoderResult
     */
    private function createResultMock()
    {
        return $this->createMock(GeocoderResult::class);
    }
}
