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

use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;

/**
 * Autocomplete component restriction test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteComponentRestrictionTest extends \PHPUnit_Framework_TestCase
{
    public function testAutocompleteComponentRestrictions()
    {
        $this->assertSame(
            array(AutocompleteComponentRestriction::COUNTRY),
            AutocompleteComponentRestriction::getAvailableAutocompleteComponentRestrictions()
        );
    }
}
