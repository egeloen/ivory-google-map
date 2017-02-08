<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Elevation;

use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Ivory\GoogleMap\Service\DistanceMatrix\Response\DistanceMatrixResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Tests\GoogleMap\Service\AbstractUnitServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixServiceUnitTest extends AbstractUnitServiceTest
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
        parent::setUp();

        $this->service = new DistanceMatrixService(
            $this->client,
            $this->messageFactory,
            $this->serializer
        );
    }

    public function testGeocodeWithBusinessAccount()
    {
        $request = $this->createDistanceMatrixRequestMock();
        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?foo=bar&signature=signature';

        $this->messageFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with(
                $this->identicalTo('GET'),
                $this->identicalTo($url)
            )
            ->will($this->returnValue($httpRequest = $this->createHttpRequestMock()));

        $this->client
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
            ->will($this->returnValue($result = 'result'));

        $this->serializer
            ->expects($this->once())
            ->method('deserialize')
            ->with(
                $this->identicalTo($result),
                $this->identicalTo(DistanceMatrixResponse::class),
                $this->identicalTo($this->service->getFormat()),
                $this->isInstanceOf(Context::class)
            )
            ->will($this->returnValue($response = $this->createDistanceMatrixResponseMock()));

        $response
            ->expects($this->once())
            ->method('setRequest')
            ->with($this->identicalTo($request));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/distancematrix/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($response, $this->service->process($request));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixRequestInterface
     */
    private function createDistanceMatrixRequestMock()
    {
        return $this->createMock(DistanceMatrixRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DistanceMatrixResponse
     */
    private function createDistanceMatrixResponseMock()
    {
        return $this->createMock(DistanceMatrixResponse::class);
    }
}
