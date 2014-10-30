<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers;

use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;

/**
 * Autocomplete events test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteEventsTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents');
    }

    public function testConstants()
    {
        $this->assertSame('ivory.google_map.places_autocomplete.html', PlacesAutocompleteEvents::HTML);
        $this->assertSame('ivory.google_map.places_autocomplete.javascript', PlacesAutocompleteEvents::JAVASCRIPT);

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.init',
            PlacesAutocompleteEvents::JAVASCRIPT_INIT
        );

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.init.container',
            PlacesAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER
        );

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.base',
            PlacesAutocompleteEvents::JAVASCRIPT_BASE
        );

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.base.coordinate',
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE
        );

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.base.bound',
            PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND
        );

        $this->assertSame(
            'ivory.google_map.places_autocomplete.javascript.autocomplete',
            PlacesAutocompleteEvents::JAVASCRIPT_AUTOCOMPLETE
        );
    }
}
