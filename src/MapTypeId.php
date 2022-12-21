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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
final class MapTypeId
{
    public const HYBRID = 'hybrid';
    public const ROADMAP = 'roadmap';
    public const SATELLITE = 'satellite';
    public const TERRAIN = 'terrain';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
