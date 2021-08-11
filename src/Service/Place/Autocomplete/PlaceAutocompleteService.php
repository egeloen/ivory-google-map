<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete;

use Http\Client\Exception as HttpClientException;
use Ivory\GoogleMap\Service\Place\AbstractPlaceSerializableService;
use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Ivory\GoogleMap\Service\Place\Autocomplete\Response\PlaceAutocompleteResponse;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteService extends AbstractPlaceSerializableService
{
    public function process(PlaceAutocompleteRequestInterface $request): PlaceAutocompleteResponse
    {
        $httpRequest  = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        /** @var PlaceAutocompleteResponse $response */
        $response = $this->deserialize($httpResponse, PlaceAutocompleteResponse::class, []);
        $response->setRequest($request);

        return $response;
    }
}
