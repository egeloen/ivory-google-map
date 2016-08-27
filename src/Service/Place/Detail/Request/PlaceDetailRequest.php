<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailRequest implements PlaceDetailRequestInterface
{
    /**
     * @var string
     */
    private $placeId;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @param string $placeId
     */
    public function __construct($placeId)
    {
        $this->setPlaceId($placeId);
    }

    /**
     * @return string
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * @param string $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
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
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = ['placeid' => $this->placeId];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }
}
