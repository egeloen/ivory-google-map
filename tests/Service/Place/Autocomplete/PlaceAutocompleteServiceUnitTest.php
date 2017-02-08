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

use Ivory\GoogleMap\Service\Place\Autocomplete\PlaceAutocompleteService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Tests\GoogleMap\Service\AbstractUnitServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteServiceUnitTest extends AbstractUnitServiceTest
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
        parent::setUp();

        $this->service = new PlaceAutocompleteService(
            $this->client,
            $this->messageFactory,
            $this->serializer
        );
    }

    public function testProcessWithBusinessAccount()
    {
        $request = $this->createPlaceAutocompleteRequestMock();
        $request
            ->expects($this->once())
            ->method('buildContext')
            ->will($this->returnValue($context = 'autocomplete'));

        $request
            ->expects($this->once())
            ->method('buildQuery')
            ->will($this->returnValue($query = ['foo' => 'bar']));

        $url = 'https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar&signature=signature';

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
                $this->identicalTo(PlaceAutocompleteResponse::class),
                $this->identicalTo($this->service->getFormat()),
                $this->isInstanceOf(Context::class)
            )
            ->will($this->returnValue($response = $this->createPlaceAutocompleteResponseMock()));

        $response
            ->expects($this->once())
            ->method('setRequest')
            ->with($this->identicalTo($request));

        $businessAccount = $this->createBusinessAccountMock();
        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo('https://maps.googleapis.com/maps/api/place/'.$context.'/json?foo=bar'))
            ->will($this->returnValue($url));

        $this->service->setBusinessAccount($businessAccount);

        $this->assertSame($response, $this->service->process($request));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceAutocompleteRequestInterface
     */
    private function createPlaceAutocompleteRequestMock()
    {
        return $this->createMock(PlaceAutocompleteRequestInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PlaceAutocompleteResponse
     */
    private function createPlaceAutocompleteResponseMock()
    {
        return $this->createMock(PlaceAutocompleteResponse::class);
    }
}
