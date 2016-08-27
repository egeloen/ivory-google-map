<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Direction;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;
use Ivory\GoogleMap\Service\Direction\Response\DirectionStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionServiceTest extends AbstractServiceTest
{
    /**
     * @var DirectionService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        //sleep(2);

        parent::setUp();

        $this->service = new DirectionService($this->getClient(), $this->getMessageFactory());
    }

    public function testRoute()
    {
        $response = $this->service->route($request = $this->createRequest());

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithCoordinates()
    {
        $request = new DirectionRequest(
            new CoordinateLocation(new Coordinate(50.629381, 3.057268)),
            new CoordinateLocation(new Coordinate(48.856633, 2.352254))
        );

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDepartureTime()
    {
        $request = $this->createRequest();
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithArrivalTime()
    {
        $request = $this->createRequest();
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAddressWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new AddressLocation('Compiègne')));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithCoordinateWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new CoordinateLocation(new Coordinate(49.418079, 2.826190))));
        $request->setOptimizeWaypoints(true);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithStopoverWaypoint()
    {
        $request = $this->createRequest();
        $request->addWaypoint(new DirectionWaypoint(new AddressLocation('Compiègne'), true));

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAvoid()
    {
        $request = $this->createRequest();
        $request->setAvoid(Avoid::HIGHWAYS);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithTravelMode()
    {
        $request = $this->createRequest();
        $request->setTravelMode(TravelMode::DRIVING);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAlternatives()
    {
        $request = $this->createRequest();
        $request->setProvideRouteAlternatives(true);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAvailableTravelModes()
    {
        $request = new DirectionRequest(new AddressLocation('Brest'), new AddressLocation('Washington'));
        $request->setTravelMode(TravelMode::BICYCLING);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::ZERO_RESULTS, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getRoutes());
        $this->assertNotEmpty($response->getAvailableTravelModes());
    }

    public function testRouteWithTransit()
    {
        $request = new DirectionRequest(
            new AddressLocation('601-625 Ashbury Street, San Francisco'),
            new AddressLocation('Bike Route 95, San Francisco')
        );

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime($this->getDepartureTime());
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithUnitSystem()
    {
        $request = $this->createRequest();
        $request->setUnitSystem(UnitSystem::METRIC);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithRegion()
    {
        $request = $this->createRequest();
        $request->setRegion('fr');

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithHttp()
    {
        $request = $this->createRequest();
        $this->service->setHttps(false);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithXmlFormat()
    {
        $request = $this->createRequest();

        $this->service->setFormat(DirectionService::FORMAT_XML);
        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithKey()
    {
        $this->service = new DirectionService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createDirectionRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/directions/json?foo=bar&key=api-key'
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
            ->will($this->returnValue('{"status":"OK","routes":[]}'));

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getRoutes());
    }

    public function testRouteWithBusinessAccount()
    {
        $this->service = new DirectionService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createDirectionRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/directions/json?foo=bar&signature=signature'
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
            ->will($this->returnValue('{"status":"OK","routes":[]}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/directions/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $response = $this->service->route($request);

        $this->assertSame(DirectionStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getRoutes());
    }

    /**
     * @return DirectionRequest
     */
    private function createRequest()
    {
        return new DirectionRequest(new AddressLocation('Lille'), new AddressLocation('Paris'));
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
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionRequest
     */
    private function createDirectionRequestMock()
    {
        return $this->createMock(DirectionRequest::class);
    }
}
