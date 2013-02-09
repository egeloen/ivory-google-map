<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap;

/**
 * Map type ID which describes a google map type ID.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeId
{
    const HYBRID = 'hybrid';
    const ROADMAP = 'roadmap';
    const SATELLITE = 'satellite';
    const TERRAIN = 'terrain';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {

    }

    /**
     * Gets the available map type IDs.
     *
     * @return array The map type IDs.
     */
    public static function getMapTypeIds()
    {
        return array(
            self::HYBRID,
            self::ROADMAP,
            self::SATELLITE,
            self::TERRAIN,
        );
    }
}
