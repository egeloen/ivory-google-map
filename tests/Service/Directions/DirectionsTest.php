<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Directions;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Avoid;
use Ivory\GoogleMap\Service\Base\TravelMode;
use Ivory\GoogleMap\Service\Base\UnitSystem;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Directions\Directions;
use Ivory\GoogleMap\Service\Directions\DirectionsRequest;
use Ivory\GoogleMap\Service\Directions\DirectionsStatus;
use Ivory\GoogleMap\Service\Directions\DirectionsWaypoint;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsTest extends AbstractServiceTest
{
    /**
     * @var Directions
     */
    private $directions;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        /*

            Uncomment when generating the http cache.
            It needs to wait a little bit between test cases
            in order to not hit the OVER_QUERY_LIMIT...

         */

        // sleep(2);

        parent::setUp();

        $this->directions = new Directions($this->getClient(), $this->getMessageFactory());
    }

    public function testRoute()
    {
        $request = new DirectionsRequest('Lille', 'Paris');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithCoordinates()
    {
        $request = new DirectionsRequest(
            new Coordinate(50.629381, 3.057268),
            new Coordinate(48.856633, 2.352254)
        );

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDepartureTime()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setDepartureTime($this->getDepartureTime());

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithArrivalTime()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithStringWaypoint()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->addWaypoint(new DirectionsWaypoint('Compiègne'));
        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithCoordinateWaypoint()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->addWaypoint(new DirectionsWaypoint(new Coordinate(49.418079, 2.826190)));
        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithStopoverWaypoint()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->addWaypoint(new DirectionsWaypoint('Compiègne', true));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAvoid()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setAvoid(Avoid::HIGHWAYS);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithTravelMode()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setTravelMode(TravelMode::DRIVING);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAlternatives()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setProvideRouteAlternatives(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithAvailableTravelModes()
    {
        $request = new DirectionsRequest('Brest', 'Washington');
        $request->setTravelMode(TravelMode::BICYCLING);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::ZERO_RESULTS, $response->getStatus());
        $this->assertEmpty($response->getRoutes());
        $this->assertNotEmpty($response->getAvailableTravelModes());
    }

    public function testRouteWithTransit()
    {
        $request = new DirectionsRequest(
            '601-625 Ashbury Street, San Francisco',
            'Bike Route 95, San Francisco'
        );

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime($this->getDepartureTime());
        $request->setArrivalTime($this->getArrivalTime());

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithUnitSystem()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setUnitSystem(UnitSystem::METRIC);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithRegion()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setRegion('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithLanguage()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setLanguage('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithHttp()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $this->directions->setHttps(false);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithXmlFormat()
    {
        $request = new DirectionsRequest('Lille', 'Paris');

        $this->directions->setFormat(Directions::FORMAT_XML);
        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithKey()
    {
        $this->directions = new Directions(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->directions->setKey('api-key');

        $request = $this->createDirectionsRequestMock();
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

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getRoutes());
    }

    public function testRouteWithBusinessAccount()
    {
        $this->directions = new Directions(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createDirectionsRequestMock();
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

        $this->directions->setBusinessAccount($businessAccount);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertEmpty($response->getRoutes());
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
     * @return \PHPUnit_Framework_MockObject_MockObject|DirectionsRequest
     */
    private function createDirectionsRequestMock()
    {
        return $this->createMock(DirectionsRequest::class);
    }
}
