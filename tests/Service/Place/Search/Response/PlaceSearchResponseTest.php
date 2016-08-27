<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchStatus;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceSearchResponse
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = new PlaceSearchResponse();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->response->hasStatus());
        $this->assertNull($this->response->getStatus());
        $this->assertFalse($this->response->hasRequest());
        $this->assertNull($this->response->getRequest());
        $this->assertFalse($this->response->hasResults());
        $this->assertEmpty($this->response->getResults());
        $this->assertFalse($this->response->hasNextPageToken());
        $this->assertNull($this->response->getNextPageToken());
        $this->assertFalse($this->response->hasHtmlAttributions());
        $this->assertEmpty($this->response->getHtmlAttributions());
    }

    public function testStatus()
    {
        $this->response->setStatus($status = PlaceSearchStatus::OK);

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

    public function testNextPageToken()
    {
        $this->response->setNextPageToken($nextPageToken = 'token');

        $this->assertTrue($this->response->hasNextPageToken());
        $this->assertSame($nextPageToken, $this->response->getNextPageToken());
    }

    public function testSetHtmlAttributions()
    {
        $this->response->setHtmlAttributions($htmlAttributions = [$htmlAttribution = 'attribution']);
        $this->response->setHtmlAttributions($htmlAttributions);

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertTrue($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertSame($htmlAttributions, $this->response->getHtmlAttributions());
    }

    public function testAddHtmlAttributions()
    {
        $this->response->setHtmlAttributions($firstHtmlAttributions = ['attribution1']);
        $this->response->addHtmlAttributions($secondHtmlAttributions = ['attribution2']);

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertSame(
            array_merge($firstHtmlAttributions, $secondHtmlAttributions),
            $this->response->getHtmlAttributions()
        );
    }

    public function testAddHtmlAttribution()
    {
        $this->response->addHtmlAttribution($htmlAttribution = 'attribution');

        $this->assertTrue($this->response->hasHtmlAttributions());
        $this->assertTrue($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertSame([$htmlAttribution], $this->response->getHtmlAttributions());
    }

    public function testRemoveHtmlAttribution()
    {
        $this->response->addHtmlAttribution($htmlAttribution = 'attribution');
        $this->response->removeHtmlAttribution($htmlAttribution);

        $this->assertFalse($this->response->hasHtmlAttributions());
        $this->assertFalse($this->response->hasHtmlAttribution($htmlAttribution));
        $this->assertEmpty($this->response->getHtmlAttributions());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceSearchRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(PlaceSearchRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Place
     */
    private function createResultMock()
    {
        return $this->createMock(Place::class);
    }
}
