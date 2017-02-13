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
    /**
     * @var string
     */
    private $reference;

    /**
     * @var int|null
     */
    private $maxWidth;

    /**
     * @var int|null
     */
    private $maxHeight;

    /**
     * @param string $reference
     */
    public function __construct($reference)
    {
        $this->setReference($reference);
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return bool
     */
    public function hasMaxWidth()
    {
        return $this->maxWidth !== null;
    }

    /**
     * @return int|null
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

    /**
     * @param int|null $maxWidth
     */
    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;
    }

    /**
     * @return bool
     */
    public function hasMaxHeight()
    {
        return $this->maxHeight !== null;
    }

    /**
     * @return int|null
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }

    /**
     * @param int|null $maxHeight
     */
    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
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
