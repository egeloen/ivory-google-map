<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Photo;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\Place\AbstractPlaceService;
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoService extends AbstractPlaceService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'photo');
    }

    /**
     * {@inheritdoc}
     */
    public function setHttps($https)
    {
        if (!$https) {
            throw new \InvalidArgumentException('The http scheme is not supported.');
        }

        parent::setHttps($https);
    }

    /**
     * @param PlacePhotoRequestInterface $request
     *
     * @return StreamInterface
     */
    public function process(PlacePhotoRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        return $httpResponse->getBody();
    }
}
