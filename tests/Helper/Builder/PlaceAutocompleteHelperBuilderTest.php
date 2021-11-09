<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Builder\AbstractJavascriptHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelperBuilderTest extends TestCase
{
    private PlaceAutocompleteHelperBuilder $placeAutocompleteHelperBuilder;

    protected function setUp(): void
    {
        $this->placeAutocompleteHelperBuilder = PlaceAutocompleteHelperBuilder::create();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractJavascriptHelperBuilder::class, $this->placeAutocompleteHelperBuilder);
    }

    public function testBuild()
    {
        $this->assertInstanceOf(PlaceAutocompleteHelper::class, $this->placeAutocompleteHelperBuilder->build());
    }
}
