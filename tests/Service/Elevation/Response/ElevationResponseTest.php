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
        $this->assertFalse($this->response->hasResults());
        $this->assertEmpty($this->response->getResults());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = ElevationStatus::OK);

        $this->assertTrue($this->response->hasStatus());
        $this->assertSame($status, $this->response->getStatus());
    }

    public function testResetStatus()
    {
        $this->response->setStatus(ElevationStatus::OK);
        $this->response->setStatus(null);

        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
    }

    public function testSetResults()
    {
        $this->response->setResults($results = [$result = $this->createElevationResultMock()]);
        $this->response->setResults($results);

        $this->assertTrue($this->response->hasResults());
        $this->assertTrue($this->response->hasResult($result));
        $this->assertSame($results, $this->response->getResults());
    }

    public function testAddResults()
    {
        $this->response->setResults($firstResults = [$this->createElevationResultMock()]);
        $this->response->addResults($secondResults = [$this->createElevationResultMock()]);

        $this->assertTrue($this->response->hasResults());
        $this->assertSame(array_merge($firstResults, $secondResults), $this->response->getResults());
    }

    public function testAddResult()
    {
        $this->response->addResult($result = $this->createElevationResultMock());

        $this->assertTrue($this->response->hasResults());
        $this->assertTrue($this->response->hasResult($result));
        $this->assertSame([$result], $this->response->getResults());
    }

    public function testRemoveResult()
    {
        $this->response->addResult($result = $this->createElevationResultMock());
        $this->response->removeResult($result);

        $this->assertFalse($this->response->hasResults());
        $this->assertFalse($this->response->hasResult($result));
        $this->assertEmpty($this->response->getResults());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ElevationResult
     */
    private function createElevationResultMock()
    {
        return $this->createMock(ElevationResult::class);
    }
}
