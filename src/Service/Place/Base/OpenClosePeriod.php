<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OpenClosePeriod
{
    /**
     * @var int|null
     */
    private $day;

    /**
     * @var \DateTime|null
     */
    private $time;

    /**
     * @return bool
     */
    public function hasDay()
    {
        return $this->day !== null;
    }

    /**
     * @return int|null
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param int|null $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return bool
     */
    public function hasTime()
    {
        return $this->time !== null;
    }

    /**
     * @return \DateTime|null
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime|null $time
     */
    public function setTime(\DateTime $time = null)
    {
        $this->time = $time;
    }
}
