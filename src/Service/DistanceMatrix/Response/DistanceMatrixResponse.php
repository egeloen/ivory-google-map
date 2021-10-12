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
    private ?string $status = null;

    private ?DistanceMatrixRequestInterface $request = null;

    /**
     * @var string[]
     */
    private array $origins = [];

    /**
     * @var string[]
     */
    private array $destinations = [];

    /**
     * @var DistanceMatrixRow[]
     */
    private array $rows = [];

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

    public function getRequest(): ?DistanceMatrixRequestInterface
    {
        return $this->request;
    }

    /**
     * @param DistanceMatrixRequestInterface|null $request
     */
    public function setRequest(DistanceMatrixRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasOrigins(): bool
    {
        return !empty($this->origins);
    }

    /**
     * @return string[]
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * @param string[] $origins
     */
    public function setOrigins(array $origins): void
    {
        $this->origins = [];
        $this->addOrigins($origins);
    }

    /**
     * @param string[] $origins
     */
    public function addOrigins(array $origins): void
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * @param string $origin
     */
    public function hasOrigin($origin): bool
    {
        return in_array($origin, $this->origins, true);
    }

    /**
     * @param string $origin
     */
    public function addOrigin($origin): void
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    /**
     * @param string $origin
     */
    public function removeOrigin($origin): void
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
        $this->origins = empty($this->origins) ? [] : array_values($this->origins);
    }

    public function hasDestinations(): bool
    {
        return !empty($this->destinations);
    }

    /**
     * @return string[]
     */
    public function getDestinations(): array
    {
        return $this->destinations;
    }

    /**
     * @param string[] $destinations
     */
    public function setDestinations(array $destinations): void
    {
        $this->destinations = [];
        $this->addDestinations($destinations);
    }

    /**
     * @param string[] $destinations
     */
    public function addDestinations(array $destinations): void
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * @param string $destination
     */
    public function hasDestination($destination): bool
    {
        return in_array($destination, $this->destinations, true);
    }

    /**
     * @param string $destination
     */
    public function addDestination($destination): void
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    /**
     * @param string $destination
     */
    public function removeDestination($destination): void
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
        $this->destinations = empty($this->destinations) ? [] : array_values($this->destinations);
    }

    public function hasRows(): bool
    {
        return !empty($this->rows);
    }

    /**
     * @return DistanceMatrixRow[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param DistanceMatrixRow[] $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = [];
        $this->addRows($rows);
    }

    /**
     * @param DistanceMatrixRow[] $rows
     */
    public function addRows(array $rows): void
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    public function hasRow(DistanceMatrixRow $row): bool
    {
        return in_array($row, $this->rows, true);
    }

    public function addRow(DistanceMatrixRow $row): void
    {
        if (!$this->hasRow($row)) {
            $this->rows[] = $row;
        }
    }

    public function removeRow(DistanceMatrixRow $row): void
    {
        unset($this->rows[array_search($row, $this->rows, true)]);
        $this->rows = empty($this->rows) ? [] : array_values($this->rows);
    }
}
