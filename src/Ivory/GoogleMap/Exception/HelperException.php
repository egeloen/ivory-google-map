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

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\MapTypeId;

/**
 * Helper exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperException extends Exception
{
    /**
     * Gets the "INVALID ANIMATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID ANIMATION" exception.
     */
    public static function invalidAnimation()
    {
        return new static(sprintf('The animation can only be : %s.', implode(', ', Animation::getAnimations())));
    }

    /**
     * Gets the "INVALID CONTROL POSITION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID CONTROL POSITION" exception.
     */
    public static function invalidControlPosition()
    {
        return new static(sprintf(
            'The control position can only be : %s.',
            implode(', ', ControlPosition::getControlPositions())
        ));
    }

    /**
     * Gets the "INVALID ENCODED PATH" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID ENCODED PATH" exception.
     */
    public static function invalidEncodedPath()
    {
        return new static('The encoded path must be a string value.');
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID MAP TYPE CONTROL STYLE" exception.
     */
    public static function invalidMapTypeControlStyle()
    {
        return new static(sprintf(
            'The map type control style can only be : %s.',
            implode(', ', MapTypeControlStyle::getMapTypeControlStyles())
        ));
    }

    /**
     * Gets the "INVALID MAP TYPE ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID MAP TYPE ID" exception.
     */
    public static function invalidMapTypeId()
    {
        return new static(sprintf('The map type id can only be : %s.', implode(', ', MapTypeId::getMapTypeIds())));
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE BOUND" exception.
     *
     * @return \Ivory\GoogleMap\Exception\TemplatingException The "INVALID AUTOCOMPLETE BOUND" exception.
     */
    public static function invalidAutocompleteBound()
    {
        return new static('The place autocomplete bound must have coordinates.');
    }

    /**
     * Gets the "INVALID SCALE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID SCALE CONTROL STYLE" exception.
     */
    public static function invalidScaleControlStyle()
    {
        return new static(sprintf(
            'The scale control style can only be : %s.',
            implode(', ', ScaleControlStyle::getScaleControlStyles())
        ));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\HelperException The "INVALID ZOOM CONTROL STYLE" exception.
     */
    public static function invalidZoomControlStyle()
    {
        return new static(sprintf(
            'The zoom control style can only be : %s.',
            implode(', ', ZoomControlStyle::getZoomControlStyles())
        ));
    }
}
