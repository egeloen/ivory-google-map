<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\TimeZone\Response;

use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneResponse
{
    private ?string $status = null;

    private ?TimeZoneRequestInterface $request = null;

    private ?int $dstOffset = null;

    private ?int $rawOffset = null;

    private ?string $timeZoneId = null;

    private ?string $timeZoneName = null;

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

    public function getRequest(): ?TimeZoneRequestInterface
    {
        return $this->request;
    }

    /**
     * @param TimeZoneRequestInterface|null $request
     */
    public function setRequest(TimeZoneRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasDstOffset(): bool
    {
        return $this->dstOffset !== null;
    }

    public function getDstOffset(): ?int
    {
        return $this->dstOffset;
    }

    /**
     * @param int|null $dstOffset
     */
    public function setDstOffset($dstOffset): void
    {
        $this->dstOffset = $dstOffset;
    }

    public function hasRawOffset(): bool
    {
        return $this->rawOffset !== null;
    }

    public function getRawOffset(): ?int
    {
        return $this->rawOffset;
    }

    /**
     * @param int|null $rawOffset
     */
    public function setRawOffset($rawOffset): void
    {
        $this->rawOffset = $rawOffset;
    }

    public function hasTimeZoneId(): bool
    {
        return $this->timeZoneId !== null;
    }

    public function getTimeZoneId(): ?string
    {
        return $this->timeZoneId;
    }

    /**
     * @param string|null $timeZoneId
     */
    public function setTimeZoneId($timeZoneId): void
    {
        $this->timeZoneId = $timeZoneId;
    }

    public function hasTimeZoneName(): bool
    {
        return $this->timeZoneName !== null;
    }

    public function getTimeZoneName(): ?string
    {
        return $this->timeZoneName;
    }

    /**
     * @param string|null $timeZoneName
     */
    public function setTimeZoneName($timeZoneName): void
    {
        $this->timeZoneName = $timeZoneName;
    }
}
