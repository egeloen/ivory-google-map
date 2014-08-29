<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Places;

/**
 * Place autocomplete type.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteType
{
    const ESTABLISHMENT = 'establishment';
    const GEOCODE = 'geocode';
    const REGIONS = '(regions)';
    const CITIES = '(cities)';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available autocomplete types.
     *
     * @return array The available autocomplete types.
     */
    public static function getAvailableAutocompleteTypes()
    {
        return array(
            self::ESTABLISHMENT,
            self::GEOCODE,
            self::REGIONS,
            self::CITIES,
        );
    }
}
