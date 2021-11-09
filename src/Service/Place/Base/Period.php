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
class Period
{
    private ?OpenClosePeriod $open = null;

    private ?OpenClosePeriod $close = null;

    public function hasOpen(): bool
    {
        return $this->open !== null;
    }

    public function getOpen(): ?OpenClosePeriod
    {
        return $this->open;
    }

    /**
     * @param OpenClosePeriod|null $open
     */
    public function setOpen(OpenClosePeriod $open = null): void
    {
        $this->open = $open;
    }

    public function hasClose(): bool
    {
        return $this->close !== null;
    }

    public function getClose(): ?OpenClosePeriod
    {
        return $this->close;
    }

    /**
     * @param OpenClosePeriod|null $close
     */
    public function setClose(OpenClosePeriod $close = null): void
    {
        $this->close = $close;
    }
}
