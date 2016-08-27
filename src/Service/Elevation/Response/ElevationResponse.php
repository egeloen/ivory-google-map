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
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var ElevationRequestInterface|null
     */
    private $request;

    /**
     * @var ElevationResult[]
     */
    private $results = [];

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
     * @return ElevationRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param ElevationRequestInterface|null $request
     */
    public function setRequest(ElevationRequestInterface $request = null)
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
     * @return ElevationResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param ElevationResult[] $results
     */
    public function setResults(array $results)
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param ElevationResult[] $results
     */
    public function addResults(array $results)
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    /**
     * @param ElevationResult $result
     *
     * @return bool
     */
    public function hasResult(ElevationResult $result)
    {
        return in_array($result, $this->results, true);
    }

    /**
     * @param ElevationResult $result
     */
    public function addResult(ElevationResult $result)
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    /**
     * @param ElevationResult $result
     */
    public function removeResult(ElevationResult $result)
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = array_values($this->results);
    }
}
