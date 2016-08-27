<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Photo;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\BusinessAccount;
use Ivory\GoogleMap\Service\Place\Photo\PlacePhotoService;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequestInterface;
use Ivory\Tests\GoogleMap\Service\AbstractServiceTest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoServiceTest extends AbstractServiceTest
{
    /**
     * @var PlacePhotoService
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

        $this->service = new PlacePhotoService($this->getClient(), $this->getMessageFactory());
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

    public function testProcessWithMaxWidth()
    {
        $request = $this->createRequest();
        $request->setMaxWidth(400);

        $stream = $this->service->process($request);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertSame(file_get_contents(__DIR__.'/Fixtures/max_width.jpg'), (string) $stream);
    }

    public function testProcessWithMaxHeight()
    {
        $request = $this->createRequest();
        $request->setMaxHeight(400);

        $stream = $this->service->process($request);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertSame(file_get_contents(__DIR__.'/Fixtures/max_height.jpg'), (string) $stream);
    }

    public function testProcessWithApiKey()
    {
        $this->service = new PlacePhotoService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $this->service->setKey('api-key');

        $request = $this->createPlacePhotoRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/place/photo?foo=bar&key=api-key'
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

        $this->assertSame($httpStream, $this->service->process($request));
    }

    public function testProcessWithBusinessAccount()
    {
        $this->service = new PlacePhotoService(
            $client = $this->createHttpClientMock(),
            $messageFactory = $this->createMessageFactoryMock()
        );

        $request = $this->createPlacePhotoRequestMock();
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
                    $url = 'https://maps.googleapis.com/maps/api/place/photo?foo=bar&signature=signature'
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

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/photo?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($httpStream, $this->service->process($request));
    }

    /**
     * @return PlacePhotoRequest
     */
    private function createRequest()
    {
        return new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU');
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
     * @return \PHPUnit_Framework_MockObject_MockObject|PlacePhotoRequestInterface
     */
    private function createPlacePhotoRequestMock()
    {
        return $this->createMock(PlacePhotoRequestInterface::class);
    }
}
