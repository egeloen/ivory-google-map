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

use Exception as BaseException;

/**
 * Ivory google map exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Exception extends BaseException
{
    /**
     * Gets the "METHOD NOT SUPPORTED" exception.
     *
     * @param string $method The method name.
     *
     * @return \Ivory\GoogleMap\Exception\Exception The "METHOD NOT SUPPORTED" exception.
     */
    public static function methodNotSupported($method)
    {
        return new static(sprintf('The method "%s" is not supported.', $method));
    }
}
