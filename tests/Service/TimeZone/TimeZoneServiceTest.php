<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\TimeZone;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequest;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneStatus;
use Ivory\GoogleMap\Service\TimeZone\TimeZoneService;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneServiceTest extends AbstractSerializableServiceTest
{
    protected ?TimeZoneService $service = null;

    protected function setUp(): void
    {
        if (!isset($_SERVER['API_KEY'])) {
            $this->markTestSkipped();
        }

        parent::setUp();

        $this->service = new TimeZoneService($this->client, $this->messageFactory);
        $this->service->setKey($_SERVER['API_KEY']);
    }

    /**
     *
     */
    public function testProcess()
    {
        $request = $this->createRequest();

        $response = $this->service->process($request);

        $this->assertTimeZoneResponse($response, $request);
    }

    /**
     *
     */
    public function testProcessWithLanguage()
    {
        $request = $this->createRequest();
        $request->setLanguage('fr');

        $response = $this->service->process($request);

        $this->assertTimeZoneResponse($response, $request);
    }

    /**
     *
     *
     * @expectedException \Http\Client\Common\Exception\ClientErrorException
     * @expectedExceptionMessage REQUEST_DENIED
     */
    public function testErrorRequest()
    {
        $this->service->setKey('invalid');

        $this->service->process($this->createRequest());
    }

    /**
     * @return TimeZoneRequest
     */
    private function createRequest()
    {
        return new TimeZoneRequest(
            new Coordinate(39.6034810, -119.6822510),
            new \DateTime('@1331161200')
        );
    }

    /**
     * @param TimeZoneResponse         $response
     * @param TimeZoneRequestInterface $request
     */
    private function assertTimeZoneResponse($response, $request)
    {
        $options = array_merge([
            'dstOffset'    => null,
            'rawOffset'    => null,
            'timeZoneId'   => null,
            'timeZoneName' => null,
        ], self::$journal->getData());

        $options['status'] = TimeZoneStatus::OK;

        $this->assertInstanceOf(TimeZoneResponse::class, $response);

        $this->assertSame($request, $response->getRequest());
        $this->assertSame($options['status'], $response->getStatus());
        $this->assertSame($options['dstOffset'], $response->getDstOffset());
        $this->assertSame($options['rawOffset'], $response->getRawOffset());
        $this->assertSame($options['timeZoneId'], $response->getTimeZoneId());
        $this->assertSame($options['timeZoneName'], $response->getTimeZoneName());
    }
}
