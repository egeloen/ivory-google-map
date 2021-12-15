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
    private ?int $day = null;

    private ?string $time = null;

    public function hasDay(): bool
    {
        return $this->day !== null;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    /**
     * @param int|null $day
     */
    public function setDay($day): void
    {
        $this->day = $day;
    }

    public function hasTime(): bool
    {
        return $this->time !== null;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }
}
