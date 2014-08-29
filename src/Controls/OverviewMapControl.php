<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

use Ivory\GoogleMap\Exception\ControlException;

/**
 * An overview map control describes a google map overview control.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#OverviewMapControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControl
{
    /** @var boolean */
    protected $opened;

    /**
     * Create an overview map control.
     *
     * @param boolean $opened TRUE if the overview map control is opened else FALSE.
     */
    public function __construct($opened = false)
    {
        $this->setOpened($opened);
    }

    /**
     * Checks if the overview map control is opened.
     *
     * @return boolean TRUE if the overview map control is opened else FALSE.
     */
    public function isOpened()
    {
        return $this->opened;
    }

    /**
     * Sets if the overview map control is opened.
     *
     * @param boolean $opened TRUE if the overview map control is opened else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the opened flag is not valid.
     */
    public function setOpened($opened)
    {
        if (!is_bool($opened)) {
            throw ControlException::invalidOverviewMapControlOpened();
        }

        $this->opened = $opened;
    }
}
