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
    /**
     * @var string|null
     */
    private $reference;

    /**
     * @var int|null
     */
    private $width;

    /**
     * @var int|null
     */
    private $height;

    /**
     * @var string[]
     */
    private $htmlAttributions = [];

    /**
     * @return bool
     */
    public function hasReference()
    {
        return $this->reference !== null;
    }

    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return bool
     */
    public function hasWidth()
    {
        return $this->width !== null;
    }

    /**
     * @return int|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return bool
     */
    public function hasHeight()
    {
        return $this->height !== null;
    }

    /**
     * @return int|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return bool
     */
    public function hasHtmlAttributions()
    {
        return !empty($this->htmlAttributions);
    }

    /**
     * @return string[]
     */
    public function getHtmlAttributions()
    {
        return $this->htmlAttributions;
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function setHtmlAttributions(array $htmlAttributions)
    {
        $this->htmlAttributions = [];
        $this->addHtmlAttributions($htmlAttributions);
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function addHtmlAttributions(array $htmlAttributions)
    {
        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }
    }

    /**
     * @param string $htmlAttribution
     *
     * @return bool
     */
    public function hasHtmlAttribution($htmlAttribution)
    {
        return in_array($htmlAttribution, $this->htmlAttributions, true);
    }

    /**
     * @param string $htmlAttribution
     */
    public function addHtmlAttribution($htmlAttribution)
    {
        if (!$this->hasHtmlAttribution($htmlAttribution)) {
            $this->htmlAttributions[] = $htmlAttribution;
        }
    }

    /**
     * @param string $htmlAttribution
     */
    public function removeHtmlAttribution($htmlAttribution)
    {
        unset($this->htmlAttributions[array_search($htmlAttribution, $this->htmlAttributions, true)]);
        $this->htmlAttributions = array_values($this->htmlAttributions);
    }
}
