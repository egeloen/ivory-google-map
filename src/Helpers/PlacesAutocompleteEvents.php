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
 * Places autocomplete events.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteEvents extends AbstractUninstantiableAsset
{
    const HTML = 'ivory.google_map.places_autocomplete.html';
    const JAVASCRIPT = 'ivory.google_map.places_autocomplete.javascript';
    const JAVASCRIPT_INIT = 'ivory.google_map.places_autocomplete.javascript.init';
    const JAVASCRIPT_INIT_CONTAINER = 'ivory.google_map.places_autocomplete.javascript.init.container';
    const JAVASCRIPT_BASE = 'ivory.google_map.places_autocomplete.javascript.base';
    const JAVASCRIPT_BASE_COORDINATE = 'ivory.google_map.places_autocomplete.javascript.base.coordinate';
    const JAVASCRIPT_BASE_BOUND = 'ivory.google_map.places_autocomplete.javascript.base.bound';
    const JAVASCRIPT_AUTOCOMPLETE = 'ivory.google_map.places_autocomplete.javascript.autocomplete';
}
