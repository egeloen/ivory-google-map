<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Exception\HelperException;
use Ivory\GoogleMap\MapTypeId;

/**
 * Map type ID helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdHelper
{
    /**
     * Renders a map map type ID.
     *
     * @param string $mapTypeId The map type ID.
     *
     * @throws \Ivory\GoogleMap\Exception\HelperException If the map type ID is not valid.
     *
     * @return string The JS output.
     */
    public function render($mapTypeId)
    {
        switch ($mapTypeId) {
            case MapTypeId::HYBRID:
            case MapTypeId::ROADMAP:
            case MapTypeId::SATELLITE:
            case MapTypeId::TERRAIN:
                return sprintf('google.maps.MapTypeId.%s', strtoupper($mapTypeId));
            default:
                throw HelperException::invalidMapTypeId();
        }
    }
}
