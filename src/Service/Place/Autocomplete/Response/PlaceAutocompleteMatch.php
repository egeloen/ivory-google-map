<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteMatch
{
    private ?int $length = null;

    private ?int $offset = null;

    public function hasLength(): bool
    {
        return $this->length !== null;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    public function hasOffset(): bool
    {
        return $this->offset !== null;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     */
    public function setOffset($offset): void
    {
        $this->offset = $offset;
    }
}
