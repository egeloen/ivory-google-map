<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Detail\Request;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailStatus;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailServiceTest extends AbstractServiceTest
{
    /**
     * @var PlaceDetailService
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

        $this->service = new PlaceDetailService($this->getClient(), $this->getMessageFactory());
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

    public function testProcess()
    {
        $response = $this->service->process($request = $this->createRequest());

        $this->assertSame(PlaceDetailStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotEmpty($response->getResult());
        $this->assertEmpty($response->getHtmlAttributions());
    }

    public function testProcessWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertSame(PlaceDetailStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotNull($response->getResult());
        $this->assertEmpty($response->getHtmlAttributions());
    }

    public function testProcessWithXmlFormat()
    {
        $this->service->setFormat(PlaceDetailService::FORMAT_XML);

        $response = $this->service->process($request = $this->createRequest());

        $this->assertSame(PlaceDetailStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNotNull($response->getResult());
        $this->assertEmpty($response->getHtmlAttributions());
    }

    public function testProcessWithApiKey()
    {
        $this->service = new PlaceDetailService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createPlaceDetailRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/place/details/json?foo=bar&key=api-key'
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
            ->will($this->returnValue('{"status": "OK", "result": null}'));

        $response = $this->service->process($request);

        $this->assertSame(PlaceDetailStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNull($response->getResult());
        $this->assertEmpty($response->getHtmlAttributions());
    }

    public function testProcessWithBusinessAccount()
    {
        $this->service = new PlaceDetailService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createPlaceDetailRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/place/details/json?foo=bar&signature=signature'
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
            ->will($this->returnValue('{"status": "OK", "result": null}'));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/details/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $response = $this->service->process($request);

        $this->assertSame(PlaceDetailStatus::OK, $response->getStatus());
        $this->assertSame($request, $response->getRequest());
        $this->assertNull($response->getResult());
        $this->assertEmpty($response->getHtmlAttributions());
    }

    /**
     * @return PlaceDetailRequest
     */
    private function createRequest()
    {
        return new PlaceDetailRequest('ChIJN1t_tDeuEmsRUsoyG83frY4');
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
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceDetailRequestInterface
     */
    private function createPlaceDetailRequestMock()
    {
        return $this->createMock(PlaceDetailRequestInterface::class);
    }
}
