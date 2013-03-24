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
 * Event exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventException extends Exception
{
    /**
     * Gets the "INVALID CAPTURE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\EventException The "INVALID CAPTURE" exception.
     */
    public static function invalidCapture()
    {
        return new static('The capture property of an event must be a boolean value.');
    }

    /**
     * Gets the "INVALID EVENT NAME" exception.
     *
     * @return \Ivory\GoogleMap\Exception\EventException The "INVALID EVENT NAME" exception.
     */
    public static function invalidEventName()
    {
        return new static('The event name of an event must be a string value.');
    }

    /**
     * Gets the "INVALID HANDLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\EventException The "INVALID HANDLE" exception.
     */
    public static function invalidHandle()
    {
        return new static('The handle of an event must be a string value.');
    }

    /**
     * Gets the "INVALID INSTANCE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\EventException The "INVALID INSTANCE" exception.
     */
    public static function invalidInstance()
    {
        return new static('The instance of an event must be a string value.');
    }
}
