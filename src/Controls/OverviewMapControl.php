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

/**
 * Overview map control.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#OverviewMapControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControl
{
    /** @var boolean */
    private $opened;

    /**
     * Creates an overview map control.
     *
     * @param boolean $opened TRUE if it is opened else FALSE.
     */
    public function __construct($opened = false)
    {
        $this->setOpened($opened);
    }

    /**
     * Checks if it is opened.
     *
     * @return boolean TRUE if it is opened else FALSE.
     */
    public function isOpened()
    {
        return $this->opened;
    }

    /**
     * Sets if it is opened.
     *
     * @param boolean $opened TRUE if it is opened else FALSE.
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;
    }
}
