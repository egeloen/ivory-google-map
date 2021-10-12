<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PageTokenPlaceSearchRequest implements PlaceSearchRequestInterface
{
    private ?PlaceSearchResponse $response = null;

    public function __construct(PlaceSearchResponse $response)
    {
        $this->setResponse($response);
    }

    public function getResponse(): PlaceSearchResponse
    {
        return $this->response;
    }

    public function setResponse(PlaceSearchResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function buildContext(): string
    {
        return $this->response->getRequest()->buildContext();
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery(): array
    {
        return ['pagetoken' => $this->response->getNextPageToken()];
    }
}
