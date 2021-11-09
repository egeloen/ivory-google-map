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
class Photo
{
    private ?string $reference = null;

    private ?int $width = null;

    private ?int $height = null;

    /**
     * @var string[]
     */
    private array $htmlAttributions = [];

    public function hasReference(): bool
    {
        return $this->reference !== null;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     */
    public function setReference($reference): void
    {
        $this->reference = $reference;
    }

    public function hasWidth(): bool
    {
        return $this->width !== null;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function hasHeight(): bool
    {
        return $this->height !== null;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function hasHtmlAttributions(): bool
    {
        return !empty($this->htmlAttributions);
    }

    /**
     * @return string[]
     */
    public function getHtmlAttributions(): array
    {
        return $this->htmlAttributions;
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function setHtmlAttributions(array $htmlAttributions): void
    {
        $this->htmlAttributions = [];
        $this->addHtmlAttributions($htmlAttributions);
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function addHtmlAttributions(array $htmlAttributions): void
    {
        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }
    }

    /**
     * @param string $htmlAttribution
     */
    public function hasHtmlAttribution($htmlAttribution): bool
    {
        return in_array($htmlAttribution, $this->htmlAttributions, true);
    }

    /**
     * @param string $htmlAttribution
     */
    public function addHtmlAttribution($htmlAttribution): void
    {
        if (!$this->hasHtmlAttribution($htmlAttribution)) {
            $this->htmlAttributions[] = $htmlAttribution;
        }
    }

    /**
     * @param string $htmlAttribution
     */
    public function removeHtmlAttribution($htmlAttribution): void
    {
        unset($this->htmlAttributions[array_search($htmlAttribution, $this->htmlAttributions, true)]);
        $this->htmlAttributions = empty($this->htmlAttributions) ? [] : array_values($this->htmlAttributions);
    }
}
