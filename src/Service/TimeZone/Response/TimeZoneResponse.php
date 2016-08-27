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
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var TimeZoneRequestInterface|null
     */
    private $request;

    /**
     * @var int|null
     */
    private $dstOffset;

    /**
     * @var int|null
     */
    private $rawOffset;

    /**
     * @var string|null
     */
    private $timeZoneId;

    /**
     * @var string|null
     */
    private $timeZoneName;

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
     * @return TimeZoneRequestInterface|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param TimeZoneRequestInterface|null $request
     */
    public function setRequest(TimeZoneRequestInterface $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function hasDstOffset()
    {
        return $this->dstOffset !== null;
    }

    /**
     * @return int|null
     */
    public function getDstOffset()
    {
        return $this->dstOffset;
    }

    /**
     * @param int|null $dstOffset
     */
    public function setDstOffset($dstOffset)
    {
        $this->dstOffset = $dstOffset;
    }

    /**
     * @return bool
     */
    public function hasRawOffset()
    {
        return $this->rawOffset !== null;
    }

    /**
     * @return int|null
     */
    public function getRawOffset()
    {
        return $this->rawOffset;
    }

    /**
     * @param int|null $rawOffset
     */
    public function setRawOffset($rawOffset)
    {
        $this->rawOffset = $rawOffset;
    }

    /**
     * @return bool
     */
    public function hasTimeZoneId()
    {
        return $this->timeZoneId !== null;
    }

    /**
     * @return string|null
     */
    public function getTimeZoneId()
    {
        return $this->timeZoneId;
    }

    /**
     * @param string|null $timeZoneId
     */
    public function setTimeZoneId($timeZoneId)
    {
        $this->timeZoneId = $timeZoneId;
    }

    /**
     * @return bool
     */
    public function hasTimeZoneName()
    {
        return $this->timeZoneName !== null;
    }

    /**
     * @return string|null
     */
    public function getTimeZoneName()
    {
        return $this->timeZoneName;
    }

    /**
     * @param string|null $timeZoneName
     */
    public function setTimeZoneName($timeZoneName)
    {
        $this->timeZoneName = $timeZoneName;
    }
}
