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

use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;
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

        $this->placeAutocompleteHelper = $this->createPlaceAutocompleteHelper();
        $this->mapHelper = $this->createMapHelper();
    }

    public function testRender()
    {
        $autocomplete = new Autocomplete();

        $control = new CustomControl(
            ControlPosition::RIGHT_TOP,
            'return document.getElementById("'.$autocomplete->getHtmlId().'")'
        );

        $map = new Map();
        $map->getControlManager()->addCustomControl($control);

        $this->render($autocomplete, $map);
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

    /**
     * @return PlaceAutocompleteHelper
     */
    protected function createPlaceAutocompleteHelper()
    {
        return PlaceAutocompleteHelperBuilder::create()->build();
    }

    /**
     * @return MapHelper
     */
    protected function createMapHelper()
    {
        return MapHelperBuilder::create()->build();
    }
}
