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

use Ivory\GoogleMap\Assets\AbstractUninstantiableAsset;

/**
 * Autocomplete type.
 *
 * @link http://developers.google.com/maps/documentation/javascript/reference#AutocompleteOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteType extends AbstractUninstantiableAsset
{
    const ESTABLISHMENT = 'establishment';
    const GEOCODE = 'geocode';
    const REGIONS = '(regions)';
    const CITIES = '(cities)';
}
