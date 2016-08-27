<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\DistanceMatrix;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceTest extends AbstractServiceTest
{
    /**
     * @var DistanceMatrixService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        //sleep(2);

        parent::setUp();

        $this->service = new DistanceMatrixService($this->getClient(), $this->getMessageFactory());
    }

    public function testProcess()
    {
        $response = $this->service->process($request = $this->createRequest());

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithCoordinates()
    {
        $request = new DistanceMatrixRequest(
            [new CoordinateLocation(new Coordinate(49.262428, -123.113136))],
            [new CoordinateLocation(new Coordinate(37.775328, -122.418938))]
        );

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithDepartureTime()
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testRouteWithArrivalTime()
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithTravelMode()
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::BICYCLING);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithAvoid()
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithRegion()
    {
        $request = $this->createRequest();
        $request->setRegion('en');

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithUnitSystem()
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::METRIC);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithHttp()
    {
        $request = $this->createRequest();
        $this->service->setHttps(false);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithXmlFormat()
    {
        $request = $this->createRequest();
        $this->service->setFormat(DistanceMatrixService::FORMAT_XML);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testRouteWithKey()
    {
        $this->service = new DistanceMatrixService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createDistanceMatrixRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo(
                    $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?foo=bar&key=api-key'
                )
            )
            ->will($this->returnValue($httpRequest = $this->createHttpRequestMock()));

        $client
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
            ->will($this->returnValue('{"status":"OK","origin_addresses":[],"destination_addresses":[],"rows":[]}'));

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getOrigins());
        $this->assertEmpty($response->getDestinations());
        $this->assertEmpty($response->getRows());
    }

    public function testRouteWithBusinessAccount()
    {
        $this->service = new DistanceMatrixService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createDistanceMatrixRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo(
                    $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?foo=bar&signature=signature'
                )
            )
            ->will($this->returnValue($httpRequest = $this->createHttpRequestMock()));

        $client
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
            ->will($this->returnValue('{"status":"OK","origin_addresses":[],"destination_addresses":[],"rows":[]}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/distancematrix/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $response = $this->service->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getOrigins());
        $this->assertEmpty($response->getDestinations());
        $this->assertEmpty($response->getRows());
    }

    /**
     * @return DistanceMatrixRequest
     */
    private function createRequest()
    {
        return new DistanceMatrixRequest(
            [new AddressLocation('Vancouver BC')],
            [new AddressLocation('San Francisco')]
        );
    }

    /**
     * @return \DateTime
     */
    private function getDepartureTime()
    {
        return $this->getDateTime('departure');
    }

    /**
     * @return \DateTime
     */
    private function getArrivalTime()
    {
        return $this->getDateTime('arrival', '+2 hours');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClient
     */
    private function createHttpClientMock()
    {
        return $this->createMock(HttpClient::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MessageFactory
     */
    private function createMessageFactoryMock()
    {
        return $this->createMock(MessageFactory::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RequestInterface
     */
    private function createHttpRequestMock()
    {
        return $this->createMock(RequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    private function createHttpResponseMock()
    {
        return $this->createMock(ResponseInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StreamInterface
     */
    private function createHttpStreamMock()
    {
        return $this->createMock(StreamInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BusinessAccount
     */
    private function createBusinessAccountMock()
    {
        return $this->createMock(BusinessAccount::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixRequest
     */
    private function createDistanceMatrixRequestMock()
    {
        return $this->createMock(DistanceMatrixRequest::class);
    }
}
