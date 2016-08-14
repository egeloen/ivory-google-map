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
    const ROUTE = 'route';
    const LOCALITY = 'locality';
    const ADMINISTRATIVE_AREA = 'administrative_area';
    const POSTAL_CODE = 'postal_code';
    const COUNTRY = 'country';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
