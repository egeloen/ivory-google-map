<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ElevationResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new ElevationResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRequest());
        $this->assertNull($this->response->getRequest());
        $this->assertFalse($this->response->hasResults());
        $this->assertEmpty($this->response->getResults());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = ElevationStatus::OK);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testRequest()
    {
        $this->response->setRequest($request = $this->createRequestMock());

        $this->assertTrue($this->response->hasRequest());
        $this->assertSame($request, $this->response->getRequest());
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
     * @return \PHPUnit_Framework_MockObject_MockObject|ElevationRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(ElevationRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ElevationResult
     */
    private function createResultMock()
    {
        return $this->createMock(ElevationResult::class);
    }
}
