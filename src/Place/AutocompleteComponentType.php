<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Place;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class AutocompleteComponentType
{
    public const ROUTE = 'route';
    public const LOCALITY = 'locality';
    public const ADMINISTRATIVE_AREA = 'administrative_area';
    public const POSTAL_CODE = 'postal_code';
    public const COUNTRY = 'country';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
