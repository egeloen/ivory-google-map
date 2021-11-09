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

use DateTime;
/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Review
{
    private ?string $authorName = null;

    private ?string $authorUrl = null;

    private ?string $text = null;

    private ?float $rating = null;

    private ?DateTime $time = null;

    private ?string $language = null;

    /**
     * @var AspectRating[]
     */
    private array $aspects = [];

    public function hasAuthorName(): bool
    {
        return $this->authorName !== null;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     */
    public function setAuthorName($authorName): void
    {
        $this->authorName = $authorName;
    }

    public function hasAuthorUrl(): bool
    {
        return $this->authorUrl !== null;
    }

    public function getAuthorUrl(): ?string
    {
        return $this->authorUrl;
    }

    /**
     * @param string|null $authorUrl
     */
    public function setAuthorUrl($authorUrl): void
    {
        $this->authorUrl = $authorUrl;
    }

    public function hasText(): bool
    {
        return $this->text !== null;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText($text): void
    {
        $this->text = $text;
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

    public function hasTime(): bool
    {
        return $this->time !== null;
    }

    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    /**
     * @param DateTime|null $time
     */
    public function setTime(DateTime $time = null): void
    {
        $this->time = $time;
    }

    public function hasLanguage(): bool
    {
        return $this->language !== null;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    public function hasAspects(): bool
    {
        return !empty($this->aspects);
    }

    /**
     * @return AspectRating[]
     */
    public function getAspects(): array
    {
        return $this->aspects;
    }

    /**
     * @param AspectRating[] $aspects
     */
    public function setAspects(array $aspects): void
    {
        $this->aspects = [];
        $this->addAspects($aspects);
    }

    /**
     * @param AspectRating[] $aspects
     */
    public function addAspects(array $aspects): void
    {
        foreach ($aspects as $aspect) {
            $this->addAspect($aspect);
        }
    }

    public function hasAspect(AspectRating $aspect): bool
    {
        return in_array($aspect, $this->aspects, true);
    }

    public function addAspect(AspectRating $aspect): void
    {
        if (!$this->hasAspect($aspect)) {
            $this->aspects[] = $aspect;
        }
    }

    public function removeAspect(AspectRating $aspect): void
    {
        unset($this->aspects[array_search($aspect, $this->aspects, true)]);
        $this->aspects = empty($this->aspects) ? [] : array_values($this->aspects);
    }
}
