<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var PlaceSearchRequestInterface|null
     */
    private $request;

    /**
     * @var Place[]
     */
    private $results = [];

    /**
     * @var string[]
     */
    private $htmlAttributions = [];

    /**
     * @var string|null
     */
    private $nextPageToken;

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
     * @return PlaceSearchRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PlaceSearchRequestInterface|null $request
     */
    public function setRequest(PlaceSearchRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasResults()
    {
        return !empty($this->results);
    }

    /**
     * @return Place[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param Place[] $results
     */
    public function setResults(array $results)
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param Place[] $results
     */
    public function addResults(array $results)
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    /**
     * @param Place $result
     *
     * @return bool
     */
    public function hasResult(Place $result)
    {
        return in_array($result, $this->results, true);
    }

    /**
     * @param Place $result
     */
    public function addResult(Place $result)
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    /**
     * @param Place $result
     */
    public function removeResult(Place $result)
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = array_values($this->results);
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

    /**
     * @return bool
     */
    public function hasNextPageToken()
    {
        return $this->nextPageToken !== null;
    }

    /**
     * @return string|null
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
    }
}
