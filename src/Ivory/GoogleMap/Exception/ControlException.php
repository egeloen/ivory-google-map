<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Exception;

use Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\Controls\ScaleControlStyle,
    Ivory\GoogleMap\Controls\ZoomControlStyle,
    Ivory\GoogleMap\MapTypeId;

/**
 * Control exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlException extends Exception
{
    /**
     * Gets the "INVALID CONTROL POSITION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID CONTROL POSITION" exception.
     */
    static public function invalidControlPosition()
    {
        return new static(sprintf('The control position can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID MAP TYPE CONTROL STYLE" exception.
     */
    static public function invalidMapTypeControlStyle()
    {
        return new static(sprintf('The map type control style can only be : %s.', implode(', ', MapTypeControlStyle::getMapTypeControlStyles())));
    }

    /**
     * Gets the "INVALID MAP TYPE ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID MAP TYPE ID" exception.
     */
    static public function invalidMapTypeId()
    {
        return new static(sprintf('The map type id can only be : %s.', implode(', ', MapTypeId::getMapTypeIds())));
    }

    /**
     * Gets the "INVALID OVERVIEW MAP CONTROL OPENED" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID OVERVIEW MAP CONTROL OPENED" exception.
     */
    static public function invalidOverviewMapControlOpened()
    {
        return new static('The opened property of an overview map control must be a boolean value.');
    }

    /**
     * Gets the "INVALID SCALE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID SCALE CONTROL STYLE" exception.
     */
    static public function invalidScaleControlStyle()
    {
        return new static(sprintf('The scale control style of a scale control can only be : %s.', implode(', ', ScaleControlStyle::getScaleControlStyles())));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID ZOOM CONTROL STYLE" exception.
     */
    static public function invalidZoomControlStyle()
    {
        return new static(sprintf('The zoom control style of a zoom control can only be : %s.', implode(', ', ZoomControlStyle::getZoomControlStyles())));
    }
}
