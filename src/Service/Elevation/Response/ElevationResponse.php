<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Response;

use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationResponse
{
    private ?string $status = null;

    private ?ElevationRequestInterface $request = null;

    /**
     * @var ElevationResult[]
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
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?ElevationRequestInterface
    {
        return $this->request;
    }

    /**
     * @param ElevationRequestInterface|null $request
     */
    public function setRequest(ElevationRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }

    /**
     * @return ElevationResult[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param ElevationResult[] $results
     */
    public function setResults(array $results): void
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param ElevationResult[] $results
     */
    public function addResults(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    public function hasResult(ElevationResult $result): bool
    {
        return in_array($result, $this->results, true);
    }

    public function addResult(ElevationResult $result): void
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    public function removeResult(ElevationResult $result): void
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = empty($this->results) ? [] : array_values($this->results);
    }
}
