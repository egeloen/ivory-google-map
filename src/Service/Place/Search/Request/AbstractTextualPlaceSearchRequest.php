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
abstract class AbstractTextualPlaceSearchRequest extends AbstractPlaceSearchRequest
{
    /**
     * @var string|null
     */
    private $keyword;

    /**
     * @return bool
     */
    public function hasKeyword()
    {
        return $this->keyword !== null;
    }

    /**
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = parent::buildQuery();

        if ($this->hasKeyword()) {
            $query['keyword'] = $this->keyword;
        }

        return $query;
    }
}
