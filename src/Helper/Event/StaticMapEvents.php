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
    public const HTML = 'map.static';
    public const CENTER = 'map.static.center';
    public const FORMAT = 'map.static.format';
    public const SCALE = 'map.static.scale';
    public const SIZE = 'map.static.size';
    public const STYLE = 'map.static.style';
    public const TYPE = 'map.static.type';
    public const ZOOM = 'map.static.zoom';
    public const MARKER = 'map.static.marker';
    public const POLYLINE = 'map.static.polyline';
    public const ENCODED_POLYLINE = 'map.static.encoded_polyline';
    public const EXTENDABLE = 'map.static.extendable';
    public const KEY = 'map.static.key';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
