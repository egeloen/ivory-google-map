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
use Ivory\Serializer\Context\Context;
use Ivory\Serializer\Naming\SnakeCaseNamingStrategy;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchService extends AbstractPlaceSerializableService
{
    /**
     * @param PlaceSearchRequestInterface $request
     *
     * @return PlaceSearchResponseIterator
     */
    public function process(PlaceSearchRequestInterface $request)
    {
//        print 'PROCESS' . "\n\n";

        $httpRequest = $this->createRequest($request);

//        print $httpRequest->getUri();

        $httpResponse = $this->getClient()->sendRequest($httpRequest);

//        if($this->getFormat()==='json') {
//            file_put_contents('place.json',(string)$httpResponse->getBody());
//        } else {
//            file_put_contents('place.xml',(string)$httpResponse->getBody());
//        }

        /** @var PlaceSearchResponse $response */
        $response = $this->deserialize(
            $httpResponse,
            PlaceSearchResponse::class,
            (new Context())->setNamingStrategy(new SnakeCaseNamingStrategy())
        );

        $response->setRequest($request);

        return new PlaceSearchResponseIterator($this, $response);
    }
}
