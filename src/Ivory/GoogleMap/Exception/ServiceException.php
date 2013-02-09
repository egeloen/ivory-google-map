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
    static public function invalidServiceFormat()
    {
        return new static(sprintf('The service format can only be : %s.', implode(', ', array('json', 'xml'))));
    }

    /**
     * Gets the "INVALID SERVICE HTTPS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ServiceException The "INVALID SERVICE HTTPS" exception.
     */
    static public function invalidServiceHttps()
    {
        return new static('The service https flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID SERVICE URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ServiceException The "INVALID SERVICE URL" exception.
     */
    static public function invalidServiceUrl()
    {
        return new static('The service url must be a string value.');
    }
}
