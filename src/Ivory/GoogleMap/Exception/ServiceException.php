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

/**
 * Service exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ServiceException extends Exception
{
    /**
     * Gets the "INVALID SERVICE FORMAT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ServiceException The "INVALID SERVICE FORMAT" exception.
     */
    public static function invalidServiceFormat()
    {
        return new static(sprintf('The service format can only be : %s.', implode(', ', array('json', 'xml'))));
    }

    /**
     * Gets the "INVALID SERVICE HTTPS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ServiceException The "INVALID SERVICE HTTPS" exception.
     */
    public static function invalidServiceHttps()
    {
        return new static('The service https flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID SERVICE URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ServiceException The "INVALID SERVICE URL" exception.
     */
    public static function invalidServiceUrl()
    {
        return new static('The service url must be a string value.');
    }

    /**
     * Gets the "INVALID DISTANCE TEXT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DISTANCE TEXT" exception.
     */
    public static function invalidDistanceText()
    {
        return new static('The distance text must be a string value.');
    }

    /**
     * Gets the "INVALID DISTANCE VALUE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DISTANCE VALUE" exception.
     */
    public static function invalidDistanceValue()
    {
        return new static('The distance value must be a numeric value.');
    }

    /**
     * Gets the "INVALID DURATION TEXT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DURATION TEXT" exception.
     */
    public static function invalidDurationText()
    {
        return new static('The duration text must be a string value.');
    }

    /**
     * Gets the "INVALID DURATION VALUE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DURATION VALUE" exception.
     */
    public static function invalidDurationValue()
    {
        return new static('The duration value must be a numeric value.');
    }
}
