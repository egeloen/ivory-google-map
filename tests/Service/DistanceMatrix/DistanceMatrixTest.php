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
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixAvoid;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixRequest;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixTest extends AbstractServiceTest
{
    /**
     * @var DistanceMatrix
     */
    private $distanceMatrix;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->distanceMatrix = new DistanceMatrix($this->getClient(), $this->getMessageFactory());
    }

    public function testProcess()
    {
        $response = $this->distanceMatrix->process(new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithCoordinates()
    {
        $response = $this->distanceMatrix->process(new DistanceMatrixRequest(
            [new Coordinate(49.262428, -123.113136)],
            [new Coordinate(37.775328, -122.418938)]
        ));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithDepartureTime()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testRouteWithArrivalTime()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithTravelMode()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setTravelMode(TravelMode::BICYCLING);

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithAvoid()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setAvoid(DistanceMatrixAvoid::HIGHWAYS);

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithRegion()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setRegion('en');

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithUnitSystem()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setUnitSystem(UnitSystem::METRIC);

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithLanguage()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);
        $request->setLanguage('fr');

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithHttps()
    {
        $this->distanceMatrix->setHttps(true);

        $response = $this->distanceMatrix->process(new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']));

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testProcessWithXmlFormat()
    {
        $request = new DistanceMatrixRequest(['Vancouver BC'], ['San Francisco']);

        $this->distanceMatrix->setFormat(DistanceMatrix::FORMAT_XML);
        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getOrigins());
        $this->assertNotEmpty($response->getDestinations());
        $this->assertNotEmpty($response->getRows());
    }

    public function testRouteWithKey()
    {
        $this->distanceMatrix = new DistanceMatrix(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->distanceMatrix->setKey('api-key');

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

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getOrigins());
        $this->assertEmpty($response->getDestinations());
        $this->assertEmpty($response->getRows());
    }

    public function testRouteWithBusinessAccount()
    {
        $this->distanceMatrix = new DistanceMatrix(
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

        $this->distanceMatrix->setBusinessAccount($businessAccount);

        $response = $this->distanceMatrix->process($request);

        $this->assertSame(DistanceMatrixStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getOrigins());
        $this->assertEmpty($response->getDestinations());
        $this->assertEmpty($response->getRows());
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
