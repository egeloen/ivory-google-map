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
    private ?string $keyword = null;

    public function hasKeyword(): bool
    {
        return $this->keyword !== null;
    }

    public function getKeyword(): ?string
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
    public function buildQuery(): array
    {
        $query = parent::buildQuery();

        if ($this->hasKeyword()) {
            $query['keyword'] = $this->keyword;
        }

        return $query;
    }
}
