<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\Tests\GoogleMap\Service\AbstractUnitServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchServiceUnitTest extends AbstractUnitServiceTest
{
    private ?PlaceSearchService $service = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PlaceSearchService(
            $this->client,
            $this->messageFactory,
            $this->serializer
        );
    }

    public function testProcessWithBusinessAccount()
    {
        $request = $this->createPlaceSearchRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'context'));

        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $url = 'https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar&signature=signature';

        $this->messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo($url)
            )
            ->will($this->returnValue($httpRequest = $this->createHttpRequestMock()));

        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->identicalTo($httpRequest))
            ->will($this->returnValue($httpResponse = $this->createHttpResponseMock()));

        $httpResponse
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($httpStream = $this->createHttpStreamMock()));

        $httpStream
            ->expects($this->once())
            ->method('__toString')
            ->will($this->returnValue($result = 'result'));

        $this->serializer
            ->expects($this->once())
            ->method('deserialize')
            ->with(
                $this->identicalTo($result),
                $this->identicalTo(PlaceSearchResponse::class),
                $this->identicalTo('json')
            )
            ->will($this->returnValue($response = $this->createPlaceSearchResponseMock()));

        $response
            ->expects($this->once())
            ->method('setRequest')
            ->with($this->identicalTo($request));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($response, $this->service->process($request)->current());
    }

    /**
     * @return MockObject|PlaceSearchRequestInterface
     */
    private function createPlaceSearchRequestMock()
    {
        return $this->createMock(PlaceSearchRequestInterface::class);
    }

    /**
     * @return MockObject|PlaceSearchResponse
     */
    private function createPlaceSearchResponseMock()
    {
        return $this->createMock(PlaceSearchResponse::class);
    }
}
