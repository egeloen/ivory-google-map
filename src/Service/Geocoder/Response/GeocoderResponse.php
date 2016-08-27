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
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var GeocoderRequestInterface|null
     */
    private $request;

    /**
     * @var GeocoderResult[]
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
    public function setStatus($status = null)
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
     * @return GeocoderRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param GeocoderRequestInterface|null $request
     */
    public function setRequest(GeocoderRequestInterface $request = null)
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
     * @return GeocoderResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param GeocoderResult[] $results
     */
    public function setResults(array $results)
    {
        $this->results = [];
        $this->addResults($results);
    }

    /**
     * @param GeocoderResult[] $results
     */
    public function addResults(array $results)
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    /**
     * @param GeocoderResult $result
     *
     * @return bool
     */
    public function hasResult(GeocoderResult $result)
    {
        return in_array($result, $this->results, true);
    }

    /**
     * @param GeocoderResult $result
     */
    public function addResult(GeocoderResult $result)
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    /**
     * @param GeocoderResult $result
     */
    public function removeResult(GeocoderResult $result)
    {
        unset($this->results[array_search($result, $this->results, true)]);
        $this->results = array_values($this->results);
    }
}
