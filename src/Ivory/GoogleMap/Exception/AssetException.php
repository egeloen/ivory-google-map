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
 * Asset exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AssetException extends Exception
{
    /**
     * Gets the "INVALID JAVASCRIPT VARIABLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\AssetException The "INVALID JAVASCRIPT VARIABLE" exception.
     */
    public static function invalidJavascriptVariable()
    {
        return new static('The javascript variable must be a string value.');
    }

    /**
     * Gets the "INVALID OPTION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\AssetException The "INVALID OPTION" exception.
     */
    public static function invalidOption()
    {
        return new static('The option property must be a string value.');
    }

    /**
     * Gets the "INVALID PREFIX JAVASCRIPT VARIABLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\AssetException The "INVALID PREFIX JAVASCRIPT VARIABLE" exception.
     */
    public static function invalidPrefixJavascriptVariable()
    {
        return new static('The prefix of a javascript variable must be a string value.');
    }

    /**
     * Gets the "OPTION DOES NOT EXIST" exception.
     *
     * @param string $option The option.
     *
     * @return \Ivory\GoogleMap\Exception\AssetException The "OPTION DOES NOT EXIST" exception.
     */
    public static function optionDoesNotExist($option)
    {
        return new static(sprintf('The option "%s" does not exist.', $option));
    }
}
