<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Autocomplete;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Place\Autocomplete\PlaceAutocompleteService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteQueryRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequest;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteServiceTest extends AbstractServiceTest
{
    /**
     * @var PlaceAutocompleteService
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

        $this->service = new PlaceAutocompleteService($this->getClient(), $this->getMessageFactory());
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

    public function testProcessWithAutocompleteRequest()
    {
        $response = $this->service->process($request = $this->createPlaceAutocompleteRequest());

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndOffset()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndLocation()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndRadius()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndTypes()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setTypes([AutocompleteType::CITIES]);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndComponents()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndLanguage()
    {
        $request = $this->createPlaceAutocompleteRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteRequestAndXmlFormat()
    {
        $this->service->setFormat(PlaceAutocompleteService::FORMAT_XML);

        $response = $this->service->process($request = $this->createPlaceAutocompleteRequest());

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequest()
    {
        $response = $this->service->process($request = $this->createPlaceAutocompleteQueryRequest());

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequestAndOffset()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setInput('Paris, Madrid');
        $request->setOffset(5);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequestAndLocation()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequestAndRadius()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLocation(new Coordinate(48.856556, 2.351970));
        $request->setRadius(1000);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequestAndLanguage()
    {
        $request = $this->createPlaceAutocompleteQueryRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithAutocompleteQueryRequestAndXmlFormat()
    {
        $this->service->setFormat(PlaceAutocompleteService::FORMAT_XML);

        $response = $this->service->process($request = $this->createPlaceAutocompleteQueryRequest());

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getPredictions());
    }

    public function testProcessWithApiKey()
    {
        $this->service = new PlaceAutocompleteService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createPlaceAutocompleteRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'autocomplete'));

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
            ->will($this->returnValue('{"status": "OK", "predictions": []}'));

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getPredictions());
    }

    public function testProcessWithBusinessAccount()
    {
        $this->service = new PlaceAutocompleteService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createPlaceAutocompleteRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'autocomplete'));

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
            ->will($this->returnValue('{"status": "OK", "predictions": []}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $response = $this->service->process($request);

        $this->assertSame(PlaceAutocompleteStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertEmpty($response->getPredictions());
    }

    /**
     * @return PlaceAutocompleteRequest
     */
    private function createPlaceAutocompleteRequest()
    {
        return new PlaceAutocompleteRequest('Paris');
    }

    /**
     * @return PlaceAutocompleteQueryRequest
     */
    private function createPlaceAutocompleteQueryRequest()
    {
        return new PlaceAutocompleteQueryRequest('Paris');
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
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceAutocompleteRequestInterface
     */
    private function createPlaceAutocompleteRequestMock()
    {
        return $this->createMock(PlaceAutocompleteRequestInterface::class);
    }
}
