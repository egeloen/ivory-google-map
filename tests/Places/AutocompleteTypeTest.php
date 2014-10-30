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
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Autocomplete type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTypeTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Places\AutocompleteType');
    }

    public function testConstants()
    {
        $this->assertSame('(cities)', AutocompleteType::CITIES);
        $this->assertSame('establishment', AutocompleteType::ESTABLISHMENT);
        $this->assertSame('geocode', AutocompleteType::GEOCODE);
        $this->assertSame('(regions)', AutocompleteType::REGIONS);
    }
}
