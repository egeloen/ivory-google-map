<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class StaticMapEvents
{
    const HTML = 'map.static';
    const CENTER = 'map.static.center';
    const FORMAT = 'map.static.format';
    const SCALE = 'map.static.scale';
    const SIZE = 'map.static.size';
    const TYPE = 'map.static.type';
    const ZOOM = 'map.static.zoom';
    const MARKER = 'map.static.marker';
    const POLYLINE = 'map.static.polyline';
    const ENCODED_POLYLINE = 'map.static.encoded_polyline';
    const EXTENDABLE = 'map.static.extendable';
    const KEY = 'map.static.key';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
