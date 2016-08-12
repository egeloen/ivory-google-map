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

use Ivory\GoogleMap\Helper\Builder\AbstractHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelperBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlaceAutocompleteHelperBuilder
     */
    private $placeAutocompleteHelperBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->placeAutocompleteHelperBuilder = PlaceAutocompleteHelperBuilder::create();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractHelperBuilder::class, $this->placeAutocompleteHelperBuilder);
    }

    public function testBuild()
    {
        $this->assertInstanceOf(PlaceAutocompleteHelper::class, $this->placeAutocompleteHelperBuilder->build());
    }
}
