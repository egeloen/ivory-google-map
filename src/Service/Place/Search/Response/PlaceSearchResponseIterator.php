<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Response;

use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Place\Search\Request\PageTokenPlaceSearchRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchResponseIterator implements \Iterator
{
    /**
     * @var PlaceSearchService
     */
    private $service;

    /**
     * @var PlaceSearchResponse[]
     */
    private $responses = [];

    /**
     * @var int|null
     */
    private $position = 0;

    /**
     * @param PlaceSearchService  $service
     * @param PlaceSearchResponse $response
     */
    public function __construct(PlaceSearchService $service, PlaceSearchResponse $response)
    {
        $this->service = $service;
        $this->responses[] = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if ($this->valid()) {
            return $this->responses[$this->position];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        if (!$this->valid()) {
            return;
        }

        ++$this->position;

        if ($this->valid()) {
            return;
        }

        $response = end($this->responses);

        if (!$response->hasNextPageToken()) {
            return;
        }

        $request = new PageTokenPlaceSearchRequest($response);
        $this->responses[] = $this->service->process($request)->current();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->position < count($this->responses);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
