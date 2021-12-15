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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TextPlaceSearchRequest extends AbstractPlaceSearchRequest
{
    private ?string $query = null;

    /**
     * @param string $query
     */
    public function __construct($query)
    {
        $this->setQuery($query);
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query): void
    {
        $this->query = $query;
    }

    public function buildContext(): string
    {
        return 'textsearch';
    }

    public function buildQuery(): array
    {
        $query = parent::buildQuery();
        $query['query'] = $this->query;

        return $query;
    }
}
