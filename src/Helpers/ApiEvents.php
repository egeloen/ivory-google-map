<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Api events.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiEvents extends AbstractUninstantiableAsset
{
    const JAVASCRIPT = 'ivory.google_map.api.javascript';
    const JAVASCRIPT_MAP = 'ivory.google_map.api.javascript.map';
    const JAVASCRIPT_MAP_ENCODED_POLYLINE = 'ivory.google_map.api.javascript.map.encoded_polyline';
    const JAVASCRIPT_MAP_MARKER_CLUSTER = 'ivory.google_map.api.javascript.map.marker_cluster';
    const JAVASCRIPT_MAP_INFO_WINDOW = 'ivory.google_map.api.javascript.map.info_window';
    const JAVASCRIPT_PLACES_AUTOCOMPLETE = 'ivory.google_map.api.javascript.places.autocomplete';
}
