<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

/**
 * Geocoder response.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponse
{
    /** @var array */
    private $results;

    /** @var string */
    private $status;

    /**
     * Creates a geocoder results.
     *
     * @param array  $results The results.
     * @param string $status  The status.
     */
    public function __construct(array $results, $status)
    {
        $this->setResults($results);
        $this->setStatus($status);
    }

    /**
     * Resets the results.
     */
    public function resetResults()
    {
        $this->results = array();
    }

    /**
     * Checks if there are results.
     *
     * @return boolean TRUE if there are results else FALSE.
     */
    public function hasResults()
    {
        return !empty($this->results);
    }

    /**
     * Gets the results.
     *
     * @return array The results.
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Sets the results
     *
     * @param array $results The results.
     */
    public function setResults(array $results)
    {
        $this->resetResults();
        $this->addResults($results);
    }

    /**
     * Adds the results
     *
     * @param array $results The results.
     */
    public function addResults(array $results)
    {
        foreach ($results as $result) {
            $this->addResult($result);
        }
    }

    /**
     * Removes the results.
     *
     * @param array $results The results.
     */
    public function removeResults(array $results)
    {
        foreach ($results as $result) {
            $this->removeResult($result);
        }
    }

    /**
     * Checks if there is a result.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderResult $result The result.
     *
     * @return boolean TRUE if there is a result else FALSE.
     */
    public function hasResult(GeocoderResult $result)
    {
        return in_array($result, $this->results, true);
    }

    /**
     * Adds a result.
     *
     * @param \Ivory\GoogleMap\Services\GeocoderResult $result The result.
     */
    public function addResult(GeocoderResult $result)
    {
        if (!$this->hasResult($result)) {
            $this->results[] = $result;
        }
    }

    /**
     * Removes a result.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\GeocoderResult $result The result.
     */
    public function removeResult(GeocoderResult $result)
    {
        unset($this->results[array_search($result, $this->results, true)]);
    }

    /**
     * Gets the status.
     *
     * @return string The status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status.
     *
     * @param string $status The status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
