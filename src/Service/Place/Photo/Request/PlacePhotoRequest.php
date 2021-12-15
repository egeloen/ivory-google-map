<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Photo\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacePhotoRequest implements PlacePhotoRequestInterface
{
    private ?string $reference = null;

    private ?int $maxWidth = null;

    private ?int $maxHeight = null;

    /**
     * @param string $reference
     */
    public function __construct($reference)
    {
        $this->setReference($reference);
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference): void
    {
        $this->reference = $reference;
    }

    public function hasMaxWidth(): bool
    {
        return $this->maxWidth !== null;
    }

    public function getMaxWidth(): ?int
    {
        return $this->maxWidth;
    }

    /**
     * @param int|null $maxWidth
     */
    public function setMaxWidth($maxWidth): void
    {
        $this->maxWidth = $maxWidth;
    }

    public function hasMaxHeight(): bool
    {
        return $this->maxHeight !== null;
    }

    public function getMaxHeight(): ?int
    {
        return $this->maxHeight;
    }

    /**
     * @param int|null $maxHeight
     */
    public function setMaxHeight($maxHeight): void
    {
        $this->maxHeight = $maxHeight;
    }

    public function buildQuery(): array
    {
        $query = ['photoreference' => $this->reference];

        if ($this->hasMaxWidth()) {
            $query['maxwidth'] = $this->maxWidth;
        }

        if ($this->hasMaxHeight()) {
            $query['maxheight'] = $this->maxHeight;
        }

        return $query;
    }
}
