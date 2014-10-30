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
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Autocomplete component restriction test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteComponentRestrictionTest extends AbstractTestCase
{
    public function testInheritance()
    {
        $this->assertUninstantiableAssetInstance('Ivory\GoogleMap\Places\AutocompleteComponentRestriction');
    }

    public function testConstants()
    {
        $this->assertSame('country', AutocompleteComponentRestriction::COUNTRY);
    }
}
