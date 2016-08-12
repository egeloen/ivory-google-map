<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class CompoundFunctionalTest extends AbstractApiFunctionalTest
{
    /**
     * @var PlaceAutocompleteHelper
     */
    private $placeAutocompleteHelper;

    /**
     * @var MapHelper
     */
    private $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->placeAutocompleteHelper = PlaceAutocompleteHelperBuilder::create()->build();
        $this->mapHelper = MapHelperBuilder::create()->build();
    }

    public function testRender()
    {
        $this->render(new Autocomplete(), new Map());
    }

    /**
     * @param Autocomplete $autocomplete
     * @param Map          $map
     */
    private function render(Autocomplete $autocomplete, Map $map)
    {
        $this->renderHtml(implode('', [
            $this->placeAutocompleteHelper->render($autocomplete),
            $this->mapHelper->render($map),
            $this->renderApi([$autocomplete, $map]),
        ]));

        $this->waitUntil(function () use ($autocomplete, $map) {
            try {
                $this->assertObjectExists($autocomplete);
                $this->assertObjectExists($map);

                return true;
            } catch (\Exception $e) {
            }
        }, 5000);
    }
}
