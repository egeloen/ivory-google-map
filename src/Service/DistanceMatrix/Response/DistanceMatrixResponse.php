<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponse
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var DistanceMatrixRequestInterface|null
     */
    private $request;

    /**
     * @var string[]
     */
    private $origins = [];

    /**
     * @var string[]
     */
    private $destinations = [];

    /**
     * @var DistanceMatrixRow[]
     */
    private $rows = [];

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
     * @return DistanceMatrixRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param DistanceMatrixRequestInterface|null $request
     */
    public function setRequest(DistanceMatrixRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasOrigins()
    {
        return !empty($this->origins);
    }

    /**
     * @return string[]
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * @param string[] $origins
     */
    public function setOrigins(array $origins)
    {
        $this->origins = [];
        $this->addOrigins($origins);
    }

    /**
     * @param string[] $origins
     */
    public function addOrigins(array $origins)
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * @param string $origin
     *
     * @return bool
     */
    public function hasOrigin($origin)
    {
        return in_array($origin, $this->origins, true);
    }

    /**
     * @param string $origin
     */
    public function addOrigin($origin)
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    /**
     * @param string $origin
     */
    public function removeOrigin($origin)
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
        $this->origins = array_values($this->origins);
    }

    /**
     * @return bool
     */
    public function hasDestinations()
    {
        return !empty($this->destinations);
    }

    /**
     * @return string[]
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @param string[] $destinations
     */
    public function setDestinations(array $destinations)
    {
        $this->destinations = [];
        $this->addDestinations($destinations);
    }

    /**
     * @param string[] $destinations
     */
    public function addDestinations(array $destinations)
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * @param string $destination
     *
     * @return bool
     */
    public function hasDestination($destination)
    {
        return in_array($destination, $this->destinations, true);
    }

    /**
     * @param string $destination
     */
    public function addDestination($destination)
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    /**
     * @param string $destination
     */
    public function removeDestination($destination)
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
        $this->destinations = array_values($this->destinations);
    }

    /**
     * @return bool
     */
    public function hasRows()
    {
        return !empty($this->rows);
    }

    /**
     * @return DistanceMatrixRow[]
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param DistanceMatrixRow[] $rows
     */
    public function setRows(array $rows)
    {
        $this->rows = [];
        $this->addRows($rows);
    }

    /**
     * @param DistanceMatrixRow[] $rows
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    /**
     * @param DistanceMatrixRow $row
     *
     * @return bool
     */
    public function hasRow(DistanceMatrixRow $row)
    {
        return in_array($row, $this->rows, true);
    }

    /**
     * @param DistanceMatrixRow $row
     */
    public function addRow(DistanceMatrixRow $row)
    {
        if (!$this->hasRow($row)) {
            $this->rows[] = $row;
        }
    }

    /**
     * @param DistanceMatrixRow $row
     */
    public function removeRow(DistanceMatrixRow $row)
    {
        unset($this->rows[array_search($row, $this->rows, true)]);
        $this->rows = array_values($this->rows);
    }
}
