<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search;

use Http\Client\Exception;
use Ivory\GoogleMap\Service\Place\AbstractPlaceSerializableService;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponseIterator;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchService extends AbstractPlaceSerializableService
{
    public function process(PlaceSearchRequestInterface $request): PlaceSearchResponseIterator
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        /** @var PlaceSearchResponse $response */
        $response = $this->deserialize($httpResponse, PlaceSearchResponse::class,[]);
        $response->setRequest($request);

        return new PlaceSearchResponseIterator($this, $response);
    }
}
