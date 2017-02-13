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
class Review
{
    /**
     * @var string|null
     */
    private $authorName;

    /**
     * @var string|null
     */
    private $authorUrl;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @var float|null
     */
    private $rating;

    /**
     * @var \DateTime|null
     */
    private $time;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @var AspectRating[]
     */
    private $aspects = [];

    /**
     * @return bool
     */
    public function hasAuthorName()
    {
        return $this->authorName !== null;
    }

    /**
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return bool
     */
    public function hasAuthorUrl()
    {
        return $this->authorUrl !== null;
    }

    /**
     * @return string|null
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * @param string|null $authorUrl
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;
    }

    /**
     * @return bool
     */
    public function hasText()
    {
        return $this->text !== null;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return bool
     */
    public function hasRating()
    {
        return $this->rating !== null;
    }

    /**
     * @return float|null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return bool
     */
    public function hasTime()
    {
        return $this->time !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime|null $time
     */
    public function setTime(\DateTime $time = null)
    {
        $this->time = $time;
    }

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return bool
     */
    public function hasAspects()
    {
        return !empty($this->aspects);
    }

    /**
     * @return AspectRating[]
     */
    public function getAspects()
    {
        return $this->aspects;
    }

    /**
     * @param AspectRating[] $aspects
     */
    public function setAspects(array $aspects)
    {
        $this->aspects = [];
        $this->addAspects($aspects);
    }

    /**
     * @param AspectRating[] $aspects
     */
    public function addAspects(array $aspects)
    {
        foreach ($aspects as $aspect) {
            $this->addAspect($aspect);
        }
    }

    /**
     * @param AspectRating $aspect
     *
     * @return bool
     */
    public function hasAspect(AspectRating $aspect)
    {
        return in_array($aspect, $this->aspects, true);
    }

    /**
     * @param AspectRating $aspect
     */
    public function addAspect(AspectRating $aspect)
    {
        if (!$this->hasAspect($aspect)) {
            $this->aspects[] = $aspect;
        }
    }

    /**
     * @param AspectRating $aspect
     */
    public function removeAspect(AspectRating $aspect)
    {
        unset($this->aspects[array_search($aspect, $this->aspects, true)]);
        $this->aspects = array_values($this->aspects);
    }
}
