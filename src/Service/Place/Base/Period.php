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
    /**
     * @var OpenClosePeriod|null
     */
    private $open;

    /**
     * @var OpenClosePeriod|null
     */
    private $close;

    /**
     * @return bool
     */
    public function hasOpen()
    {
        return $this->open !== null;
    }

    /**
     * @return OpenClosePeriod|null
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @param OpenClosePeriod|null $open
     */
    public function setOpen(OpenClosePeriod $open = null)
    {
        $this->open = $open;
    }

    /**
     * @return bool
     */
    public function hasClose()
    {
        return $this->close !== null;
    }

    /**
     * @return OpenClosePeriod|null
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * @param OpenClosePeriod|null $close
     */
    public function setClose(OpenClosePeriod $close = null)
    {
        $this->close = $close;
    }
}
