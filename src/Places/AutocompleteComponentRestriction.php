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
 * Autocomplete component restriction.
 *
 * @link http://developers.google.com/maps/documentation/javascript/reference#ComponentRestrictions
 * @author GeLo <geloen.eric@gmail.com>
 * @author Semyon Velichko <semyon@velichko.net>
 */
class AutocompleteComponentRestriction extends AbstractUninstantiableAsset
{
    const COUNTRY = 'country';
}
