<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\TimeZone;

use Http\Client\HttpClient;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneService extends AbstractSerializableService
{
    public function __construct(HttpClient $client, SerializerInterface $serializer = null)
    {
        parent::__construct('https://maps.googleapis.com/maps/api/timezone', $client, $serializer);
    }

    public function process(TimeZoneRequestInterface $request): TimeZoneResponse
    {
        $httpRequest  = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        /** @var TimeZoneResponse $response */
        $response = $this->deserialize($httpResponse, TimeZoneResponse::class, []);
        $response->setRequest($request);

        return $response;
    }
}
