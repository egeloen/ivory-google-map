<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class PriceLevel
{
    public const FREE = 0;
    public const INEXPENSIVE = 1;
    public const MODERATE = 2;
    public const EXPENSIVE = 3;
    public const VERY_EXPENSIVE = 4;

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
