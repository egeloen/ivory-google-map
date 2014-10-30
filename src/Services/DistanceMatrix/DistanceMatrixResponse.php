<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

/**
 * Distance matrix response.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixResponse
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponse
{
    /** @var string */
    private $status;

    /** @var array */
    private $destinations;

    /** @var array */
    private $origins;

    /** @var array */
    private $rows;

    /**
     * Create a distance matrix response.
     *
     * @param string $status       The status.
     * @param array  $origins      The origins.
     * @param array  $destinations The destinations.
     * @param array  $rows         The rows.
     */
    public function __construct($status, array $origins, array $destinations, array $rows)
    {
        $this->setStatus($status);
        $this->setOrigins($origins);
        $this->setDestinations($destinations);
        $this->setRows($rows);
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
     * @param string $status The tatus.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Resets the origins.
     */
    public function resetOrigins()
    {
        $this->origins = array();
    }

    /**
     * Checks if there are origin.
     *
     * @return boolean TRUE if there are origins else FALSE.
     */
    public function hasOrigins()
    {
        return !empty($this->origins);
    }

    /**
     * Gets the origins.
     *
     * @return array The origins.
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * Sets the origins.
     *
     * @param array $origins The origins.
     */
    public function setOrigins(array $origins)
    {
        $this->resetOrigins();
        $this->addOrigins($origins);
    }

    /**
     * Adds the origins.
     *
     * @param array $origins The origins.
     */
    public function addOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * Removes the origin.
     *
     * @param array $origins The origins.
     */
    public function removeOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->removeOrigin($origin);
        }
    }

    /**
     * Checks if there is an origin.
     *
     * @param string $origin The origin.
     *
     * @return boolean TRUE if there is the origin else FALSE.
     */
    public function hasOrigin($origin)
    {
        return in_array($origin, $this->origins, true);
    }

    /**
     * Adds an origin.
     *
     * @param string $origin The origin.
     */
    public function addOrigin($origin)
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    /**
     * Removes an origin.
     *
     * @param string $origin The origin.
     */
    public function removeOrigin($origin)
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
    }

    /**
     * Resets the destinations.
     */
    public function resetDestinations()
    {
        $this->destinations = array();
    }

    /**
     * Checks if there are destinations.
     *
     * @return boolean TRUE if there are destinations else FALSE.
     */
    public function hasDestinations()
    {
        return !empty($this->destinations);
    }

    /**
     * Gets the destinations.
     *
     * @return array The destinations.
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Sets the destinations.
     *
     * @param array $destinations The destinations.
     */
    public function setDestinations(array $destinations)
    {
        $this->resetDestinations();
        $this->addDestinations($destinations);
    }

    /**
     * Adds the destinations.
     *
     * @param array $destinations The destinations.
     */
    public function addDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * Removes the destinations.
     *
     * @param array $destinations The destinations.
     */
    public function removeDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->removeDestination($destination);
        }
    }

    /**
     * Checks if there is a destination.
     *
     * @param string $destination The destination.
     *
     * @return boolean TRUE if there is a destination else FALSE.
     */
    public function hasDestination($destination)
    {
        return in_array($destination, $this->destinations, true);
    }

    /**
     * Adds a destination.
     *
     * @param string $destination The destination.
     */
    public function addDestination($destination)
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    /**
     * Removes a destination.
     *
     * @param string $destination The destination.
     */
    public function removeDestination($destination)
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
    }

    /**
     * Resets the rows.
     */
    public function resetRows()
    {
        $this->rows = array();
    }

    /**
     * Checks if there are rows.
     *
     * @return boolean TRUE if there are rows else FALSE.
     */
    public function hasRows()
    {
        return !empty($this->rows);
    }

    /**
     * Gets the rows.
     *
     * @return array The rows.
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Sets the rows.
     *
     * @param array $rows The rows.
     */
    public function setRows(array $rows)
    {
        $this->resetRows();
        $this->addRows($rows);
    }

    /**
     * Adds the rows.
     *
     * @param array $rows The rows.
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    /**
     * Removes the rows.
     *
     * @param array $rows The rows.
     */
    public function removeRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->removeRow($row);
        }
    }

    /**
     * Checks if there is a row.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The row.
     *
     * @return boolean TRUE if there is the row else FALSE.
     */
    public function hasRow(DistanceMatrixResponseRow $row)
    {
        return in_array($row, $this->rows, true);
    }

    /**
     * Adds a row.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The row.
     */
    public function addRow(DistanceMatrixResponseRow $row)
    {
        if (!$this->hasRow($row)) {
            $this->rows[] = $row;
        }
    }

    /**
     * Removes a row.
     *
     * @param \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseRow $row The row.
     */
    public function removeRow(DistanceMatrixResponseRow $row)
    {
        unset($this->rows[array_search($row, $this->rows, true)]);
    }
}
