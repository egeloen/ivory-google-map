<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Detail;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\Tests\GoogleMap\Service\AbstractUnitServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailServiceUnitTest extends AbstractUnitServiceTest
{
    private PlaceDetailService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PlaceDetailService($this->client, $this->serializer);
    }

    public function testProcessWithBusinessAccount()
    {
        $request = $this->createPlaceDetailRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $url = 'https://maps.googleapis.com/maps/api/place/details/json?foo=bar&signature=signature';

        $this->client
            ->expects($this->once())
            ->method('sendRequest')
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
                $this->identicalTo(PlaceDetailResponse::class),
                $this->identicalTo('json')
            )
            ->will($this->returnValue($response = $this->createPlaceDetailResponseMock()));

        $response
            ->expects($this->once())
            ->method('setRequest')
            ->with($this->identicalTo($request));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/details/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($response, $this->service->process($request));
    }

    /**
     * @return MockObject|PlaceDetailRequestInterface
     */
    private function createPlaceDetailRequestMock()
    {
        return $this->createMock(PlaceDetailRequestInterface::class);
    }

    /**
     * @return MockObject|PlaceDetailResponse
     */
    private function createPlaceDetailResponseMock()
    {
        return $this->createMock(PlaceDetailResponse::class);
    }
}
