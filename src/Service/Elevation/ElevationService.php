<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Symfony\Component\Serializer\SerializerInterface;
/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationService extends AbstractSerializableService
{
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct('https://maps.googleapis.com/maps/api/elevation', $client, $messageFactory, $serializer);
    }

    public function process(ElevationRequestInterface $request): ElevationResponse
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        /** @var ElevationResponse $response */
        $response = $this->deserialize($httpResponse, ElevationResponse::class, []);
        $response->setRequest($request);

        return $response;
    }
}
