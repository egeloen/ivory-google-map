<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Add;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Place\Add\Request\PlaceAddRequestInterface;
use Ivory\GoogleMap\Service\Place\Add\Response\PlaceAddResponse;
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;
use Ivory\Serializer\SerializerInterface;

/**
 * @author TeLiXj <telixj@gmail.com>
 */
class PlaceAddService extends AbstractSerializableService
{
    /**
     * @param HttpClient               $client
     * @param MessageFactory           $messageFactory
     * @param SerializerInterface|null $serializer
     */
    public function __construct(
        HttpClient $client,
        MessageFactory $messageFactory,
        SerializerInterface $serializer = null
    ) {
        parent::__construct(
            'https://maps.googleapis.com/maps/api/place/add',
            $client,
            $messageFactory,
            $serializer
        );
        $this->setMethod('POST');
    }

    /**
     * @param PlaceAddRequestInterface $request
     *
     * @return PlaceAddResponse
     */
    public function process(PlaceAddRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);
        $response = $this->deserialize(
            $httpResponse,
            PlaceAddResponse::class,
            (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy())
        );

        $response->setRequest($request);

        return $response;
    }
}
