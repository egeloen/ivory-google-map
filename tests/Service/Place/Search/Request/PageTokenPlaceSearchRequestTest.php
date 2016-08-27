<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Service\ContextualizedRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Request\PageTokenPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\GoogleMap\Service\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PageTokenPlaceSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PageTokenPlaceSearchRequest
     */
    private $request;

    /**
     * @var PlaceSearchResponse|\PHPUnit_Framework_MockObject_MockObject
     */
    private $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new PageTokenPlaceSearchRequest($this->response = $this->createResponseMock());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(PlaceSearchRequestInterface::class, $this->request);
        $this->assertInstanceOf(ContextualizedRequestInterface::class, $this->request);
        $this->assertInstanceOf(RequestInterface::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->response, $this->request->getResponse());
    }

    public function testResponse()
    {
        $this->request->setResponse($response = $this->createResponseMock());

        $this->assertSame($response, $this->request->getResponse());
    }

    public function testBuildContext()
    {
        $this->response
            ->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request = $this->createRequestMock()));

        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($method = 'method'));

        $this->assertSame($method, $this->request->buildContext());
    }

    public function testBuildQuery()
    {
        $this->response
            ->expects($this->once())
            ->method('getNextPageToken')
            ->will($this->returnValue($pageToken = 'token'));

        $this->assertSame(['pagetoken' => $pageToken], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceSearchResponse
     */
    private function createResponseMock()
    {
        return $this->createMock(PlaceSearchResponse::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceSearchRequestInterface
     */
    private function createRequestMock()
    {
        return $this->createMock(PlaceSearchRequestInterface::class);
    }
}
