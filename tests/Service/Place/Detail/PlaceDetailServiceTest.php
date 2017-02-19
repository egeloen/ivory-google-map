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

        parent::setUp();

        $this->service = new PlaceDetailService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcess($format)
    {
        $request = $this->createRequest();

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceDetailResponse($response, $request);
    }

    /**
     * @param string $format
     *
     * @dataProvider formatProvider
     */
    public function testProcessWithLanguage($format)
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $this->service->setFormat($format);
        $response = $this->service->process($request);

        $this->assertPlaceDetailResponse($response, $request);
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
