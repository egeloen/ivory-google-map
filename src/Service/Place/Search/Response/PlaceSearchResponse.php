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
    private ?string $status = null;

    private ?PlaceSearchRequestInterface $request = null;

    /**
     * @var Place[]
     */
    private array $results = [];

    /**
     * @var string[]
     */
    private array $htmlAttributions = [];

    private ?string $nextPageToken = null;

    public function hasStatus(): bool
    {
        return $this->status !== null;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?PlaceSearchRequestInterface
    {
        return $this->request;
    }

    /**
     * @param PlaceSearchRequestInterface|null $request
     */
    public function setRequest(PlaceSearchRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /**
     * @return Place[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Place[] $results
     */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param Place[] $results
     */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(Place $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(Place $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(Place $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
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

    public function hasNextPageToken(): bool
    {
        return $this->nextPageToken !== null;
    }

    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     */
    public function setNextPageToken($nextPageToken): void
    {
        $this->nextPageToken = $nextPageToken;
    }
}
