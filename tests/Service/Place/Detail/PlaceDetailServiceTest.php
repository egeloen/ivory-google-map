<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Detail;

use Http\Client\Common\Exception\ClientErrorException;
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailStatus;
use Ivory\Tests\GoogleMap\Service\Place\AbstractPlaceSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailServiceTest extends AbstractPlaceSerializableServiceTest
{
    private ?PlaceDetailService $service = null;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new PlaceDetailService($this->client);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     */
    public function testProcess()
    {
        $request = $this->createRequest();

        $response = $this->service->process($request);

        $this->assertPlaceDetailResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertPlaceDetailResponse($response, $request);
    }

    public function testErrorRequest()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage('REQUEST_DENIED');
        $this->service->setKey('invalid');

        $this->service->process($this->createRequest());
    }

    /**
     * @return PlaceDetailRequest
     */
    private function createRequest()
    {
        return new PlaceDetailRequest('ChIJN1t_tDeuEmsRUsoyG83frY4');
    }

    /**
     * @param PlaceDetailResponse         $response
     * @param PlaceDetailRequestInterface $request
     */
    private function assertPlaceDetailResponse($response, $request)
    {
        $options = array_merge([
            'result'            => [],
            'html_attributions' => [],
        ], self::$journal->getData());

        $options['status'] = PlaceDetailStatus::OK;

        $this->assertInstanceOf(PlaceDetailResponse::class, $response);
        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['html_attributions'], $response->getHtmlAttributions());
        $this->assertPlace($response->getResult(), $options['result']);
    }
}
