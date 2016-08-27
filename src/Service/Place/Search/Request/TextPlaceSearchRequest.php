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
    /**
     * @var string
     */
    private $query;

    /**
     * @param string $query
     */
    public function __construct($query)
    {
        $this->setQuery($query);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * {@inheritdoc}
     */
    public function buildContext()
    {
        return 'textsearch';
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = parent::buildQuery();
        $query['query'] = $this->query;

        return $query;
    }
}
