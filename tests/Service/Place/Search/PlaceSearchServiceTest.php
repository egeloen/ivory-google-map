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

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Base\PriceLevel;
use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Place\Search\Request\NearbyPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Request\RadarPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\TextPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchServiceTest extends AbstractServiceTest
{
    /**
     * @var PlaceSearchService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        //sleep(2);

        parent::setUp();

        $this->service = new PlaceSearchService($this->getClient(), $this->getMessageFactory());
        $this->service->setKey($_SERVER['API_KEY']);
    }

    public function testHttps()
    {
        $this->service->setHttps(true);

        $this->assertTrue($this->service->isHttps());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The http scheme is not supported.
     */
    public function testHttp()
    {
        $this->service->setHttps(false);
    }

    public function testProcessWithNearbyRequest()
    {
        $request = $this->createNearbyRequest();
        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndKeyword()
    {
        $request = $this->createNearbyRequest();
        $request->setKeyword('Bank');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndNames()
    {
        $request = $this->createNearbyRequest();
        $request->setNames(['Mother', 'Breakfast']);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndMinPrice()
    {
        $request = $this->createNearbyRequest();
        $request->setMinPrice(PriceLevel::FREE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndMaxPrice()
    {
        $request = $this->createNearbyRequest();
        $request->setMaxPrice(PriceLevel::MODERATE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndOpenNow()
    {
        $request = $this->createNearbyRequest();
        $request->setOpenNow(true);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndType()
    {
        $request = $this->createNearbyRequest();
        $request->setType(PlaceType::BANK);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndLanguage()
    {
        $request = $this->createNearbyRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndKeyword()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndNames()
    {
        $request = $this->createRadarRequest();
        $request->setNames(['Mother', 'Breakfast']);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndMinPrice()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');
        $request->setMinPrice(PriceLevel::FREE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndMaxPrice()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');
        $request->setMaxPrice(PriceLevel::MODERATE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndOpenNow()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');
        $request->setOpenNow(true);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndType()
    {
        $request = $this->createRadarRequest();
        $request->setType(PlaceType::BANK);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndLanguage()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');
        $request->setLanguage('fr');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequest()
    {
        $request = $this->createTextRequest();
        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithLocation()
    {
        $request = $this->createTextRequest();
        $request->setLocation(new Coordinate(-33.857097, 150.996833));

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithRadius()
    {
        $request = $this->createTextRequest();
        $request->setRadius(5000);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithMinPrice()
    {
        $request = $this->createTextRequest();
        $request->setMinPrice(PriceLevel::MODERATE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithMaxPrice()
    {
        $request = $this->createTextRequest();
        $request->setMaxPrice(PriceLevel::MODERATE);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithOpenNow()
    {
        $request = $this->createTextRequest();
        $request->setOpenNow(true);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithType()
    {
        $request = $this->createTextRequest();
        $request->setType(PlaceType::RESTAURANT);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestWithLanguage()
    {
        $request = $this->createTextRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithNearbyRequestAndXmlFormat()
    {
        $this->service->setFormat(PlaceSearchService::FORMAT_XML);

        $request = $this->createNearbyRequest();
        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testProcessWithRadarRequestAndXmlFormat()
    {
        $this->service->setFormat(PlaceSearchService::FORMAT_XML);

        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithTextRequestAndXmlFormat()
    {
        $this->service->setFormat(PlaceSearchService::FORMAT_XML);

        $request = $this->createTextRequest();
        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNotNull($response->getNextPageToken());
    }

    public function testIteratorWithNearbyRequest()
    {
        $responses = [];
        $request = $this->createNearbyRequest();
        $iterator = $this->service->process($request);

        foreach ($iterator as $response) {
            $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
            $this->assertNotEmpty($response->getResults());
            $this->assertEmpty($response->getHtmlAttributions());

            $responses[] = $response;
            //sleep(2);
        }

        $this->assertSame($responses, iterator_to_array($iterator));
    }

    public function testIteratorWithRadarRequest()
    {
        $request = $this->createRadarRequest();
        $request->setKeyword('vegetarian');

        $responses = [];
        $iterator = $this->service->process($request);

        foreach ($iterator as $response) {
            $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
            $this->assertNotEmpty($response->getResults());
            $this->assertEmpty($response->getHtmlAttributions());

            $responses[] = $response;
            //sleep(2);
        }

        $this->assertSame($responses, iterator_to_array($iterator));
    }

    public function testIteratorWithTextRequest()
    {
        $responses = [];
        $request = $this->createTextRequest();
        $iterator = $this->service->process($request);

        foreach ($iterator as $response) {
            $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
            $this->assertNotEmpty($response->getResults());
            $this->assertEmpty($response->getHtmlAttributions());

            $responses[] = $response;
            //sleep(2);
        }

        $this->assertSame($responses, iterator_to_array($iterator));
    }

    public function testProcessWithApiKey()
    {
        $this->service = new PlaceSearchService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createPlaceSearchRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'context'));

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
                    $url = 'https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar&key=api-key'
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
            ->will($this->returnValue('{"status": "OK", "results": []}'));

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    public function testProcessWithBusinessAccount()
    {
        $this->service = new PlaceSearchService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createPlaceSearchRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'context'));

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
                    $url = 'https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar&signature=signature'
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
            ->will($this->returnValue('{"status": "OK", "results": []}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $response = $this->service->process($request)->current();

        $this->assertSame(PlaceSearchStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getResults());
        $this->assertEmpty($response->getHtmlAttributions());
        $this->assertNull($response->getNextPageToken());
    }

    /**
     * @return NearbyPlaceSearchRequest
     */
    private function createNearbyRequest()
    {
        return new NearbyPlaceSearchRequest(
            new Coordinate(-33.8670522, 151.1957362),
            PlaceSearchRankBy::PROMINENCE,
            10000
        );
    }

    /**
     * @return RadarPlaceSearchRequest
     */
    private function createRadarRequest()
    {
        return new RadarPlaceSearchRequest(
            new Coordinate(-33.8670522, 151.1957362),
            5000
        );
    }

    /**
     * @return TextPlaceSearchRequest
     */
    private function createTextRequest()
    {
        return new TextPlaceSearchRequest('Restaurants in Sydney');
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
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceSearchRequestInterface
     */
    private function createPlaceSearchRequestMock()
    {
        return $this->createMock(PlaceSearchRequestInterface::class);
    }
}
