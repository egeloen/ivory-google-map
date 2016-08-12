<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#StreetViewControlOptions
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControl
{
    /**
     * @var string
     */
    private $position;

    /**
     * @param string $position
     */
    public function __construct($position = ControlPosition::TOP_LEFT)
    {
        $this->setPosition($position);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
