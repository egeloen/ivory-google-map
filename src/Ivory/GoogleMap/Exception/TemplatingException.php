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
    Ivory\GoogleMap\Overlays\Animation,
    Ivory\GoogleMap\MapTypeId;

/**
 * Templating exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TemplatingException extends Exception
{
    /**
     * Gets the "INVALID ANIMATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID ANIMATION" exception.
     */
    static public function invalidAnimation()
    {
        return new static(sprintf('The animation can only be : %s.', implode(', ', Animation::getAnimations())));
    }

    /**
     * Gets the "INVALID CONTROL POSITION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID CONTROL POSITION" exception.
     */
    static public function invalidControlPosition()
    {
        return new static(sprintf('The control position can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }

    /**
     * Gets the "INVALID ENCODED PATH" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID ENCODED PATH" exception.
     */
    static public function invalidEncodedPath()
    {
        return new static('The encoded path must be a string value.');
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID MAP TYPE CONTROL STYLE" exception.
     */
    static public function invalidMapTypeControlStyle()
    {
        return new static(sprintf('The map type control style can only be : %s.', implode(', ', MapTypeControlStyle::getMapTypeControlStyles())));
    }

    /**
     * Gets the "INVALID MAP TYPE ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID MAP TYPE ID" exception.
     */
    static public function invalidMapTypeId()
    {
        return new static(sprintf('The map type id can only be : %s.', implode(', ', MapTypeId::getMapTypeIds())));
    }

    /**
     * Gets the "INVALID SCALE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID SCALE CONTROL STYLE" exception.
     */
    static public function invalidScaleControlStyle()
    {
        return new static(sprintf('The scale control style can only be : %s.', implode(', ', ScaleControlStyle::getScaleControlStyles())));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID ZOOM CONTROL STYLE" exception.
     */
    static public function invalidZoomControlStyle()
    {
        return new static(sprintf('The zoom control style can only be : %s.', implode(', ', ZoomControlStyle::getZoomControlStyles())));
    }
}
