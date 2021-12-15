<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AspectRating
{
    private ?string $type = null;

    private ?float $rating = null;

    public function hasType(): bool
    {
        return $this->type !== null;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function hasRating(): bool
    {
        return $this->rating !== null;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }
}
