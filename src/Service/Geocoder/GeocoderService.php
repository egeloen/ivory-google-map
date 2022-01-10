<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder;

use Http\Client\HttpClient;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;
use Ivory\GoogleMap\Service\Geocoder\Response\GeocoderResponse;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderService extends AbstractSerializableService
{
    public function __construct(HttpClient $client, SerializerInterface $serializer = null)
    {
        parent::__construct('https://maps.googleapis.com/maps/api/geocode', $client, $serializer);
    }

    public function geocode(GeocoderRequestInterface $request): GeocoderResponse
    {
        $httpRequest  = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        /** @var GeocoderResponse $response */
        $response = $this->deserialize($httpResponse, GeocoderResponse::class, []);
        $response->setRequest($request);

        return $response;
    }
}
