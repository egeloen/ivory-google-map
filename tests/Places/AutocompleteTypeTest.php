<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Places;

use Ivory\GoogleMap\Places\AutocompleteType;

/**
 * Autocomplete type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testAutocompleteTypes()
    {
        $this->assertSame(
            array(
                AutocompleteType::ESTABLISHMENT,
                AutocompleteType::GEOCODE,
                AutocompleteType::REGIONS,
                AutocompleteType::CITIES,
            ),
            AutocompleteType::getAvailableAutocompleteTypes()
        );
    }
}
