<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Place;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMap\Place\AutocompleteType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class AutocompleteFunctionalTest extends AbstractAutocompleteFunctionalTest
{
    public function testRender()
    {
        $this->renderAutocomplete($autocomplete = $this->createAutocomplete());
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithBound()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->setBound(new Bound(new Coordinate(-1, -1), new Coordinate(1, 1)));

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithTypes()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->setTypes([AutocompleteType::CITIES]);

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithComponentRestrictions()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->setComponents([AutocompleteComponentType::COUNTRY => 'fr']);

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithValue()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->setValue('value');

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithInputAttributes()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->setInputAttribute('placeholder', 'Enter your location');

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    public function testRenderWithLibraries()
    {
        $autocomplete = $this->createAutocomplete();
        $autocomplete->addLibrary('drawing');

        $this->renderAutocomplete($autocomplete);
        $this->assertAutocomplete($autocomplete);
    }

    /**
     * @return Autocomplete
     */
    private function createAutocomplete()
    {
        return new Autocomplete();
    }
}
