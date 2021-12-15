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
class PlaceAutocompleteTerm
{
    private ?string $value = null;

    private ?int $offset = null;

    public function hasValue(): bool
    {
        return $this->value !== null;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
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
