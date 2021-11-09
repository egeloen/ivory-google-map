<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Response;

use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponse
{
    private ?string $status = null;

    private ?GeocoderRequestInterface $request = null;

    /**
     * @var GeocoderResult[]
     */
    private array $results = [];

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
    public function setStatus($status = null): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?GeocoderRequestInterface
    {
        return $this->request;
    }

    /**
     * @param GeocoderRequestInterface|null $request
     */
    public function setRequest(GeocoderRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /**
     * @return GeocoderResult[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param GeocoderResult[] $results
     */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param GeocoderResult[] $results
     */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(GeocoderResult $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(GeocoderResult $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(GeocoderResult $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
    }
}
