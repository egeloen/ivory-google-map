<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\TimeZone;

use PHPUnit\Framework\MockObject\MockObject;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequest;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Ivory\GoogleMap\Service\TimeZone\TimeZoneService;
use Ivory\Tests\GoogleMap\Service\AbstractUnitServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneServiceUnitTest extends AbstractUnitServiceTest
{
    private TimeZoneService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new TimeZoneService($this->client, $this->serializer);
    }

    public function testProcessWithBusinessAccount()
    {
        $request = $this->createTimeZoneRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $url = 'https://maps.googleapis.com/maps/api/timezone/json?foo=bar&signature=signature';

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
                $this->identicalTo(TimeZoneResponse::class),
                $this->identicalTo('json')
            )
            ->will($this->returnValue($response = $this->createTimeZoneResponseMock()));

        $response
            ->expects($this->once())
            ->method('setRequest')
            ->with($this->identicalTo($request));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/timezone/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($response, $this->service->process($request));
    }

    /**
     * @return MockObject|TimeZoneRequest
     */
    private function createTimeZoneRequestMock()
    {
        return $this->createMock(TimeZoneRequest::class);
    }

    /**
     * @return MockObject|TimeZoneResponse
     */
    private function createTimeZoneResponseMock()
    {
        return $this->createMock(TimeZoneResponse::class);
    }
}
