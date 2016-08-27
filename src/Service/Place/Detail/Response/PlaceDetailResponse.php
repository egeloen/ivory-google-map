<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var PlaceDetailRequestInterface|null
     */
    private $request;

    /**
     * @var Place|null
     */
    private $result;

    /**
     * @var string[]
     */
    private $htmlAttributions = [];

    /**
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function hasRequest()
    {
        return $this->request !== null;
    }

    /**
     * @return PlaceDetailRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PlaceDetailRequestInterface|null $request
     */
    public function setRequest(PlaceDetailRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasResult()
    {
        return $this->result !== null;
    }

    /**
     * @return Place|null
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param Place|null $result
     */
    public function setResult(Place $result = null)
    {
        $this->result = $result;
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
