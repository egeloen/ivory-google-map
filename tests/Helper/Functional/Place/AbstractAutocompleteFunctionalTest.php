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

use Exception;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractApiFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractAutocompleteFunctionalTest extends AbstractApiFunctionalTest
{
    private PlaceAutocompleteHelper $placeAutocompleteHelper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->placeAutocompleteHelper = $this->createPlaceAutocompleteHelper();
    }

    /**
     * @param string|null  $html
     */
    protected function renderAutocomplete(Autocomplete $autocomplete, $html = null)
    {
        $this->renderHtml(implode('', [
            $html,
            $this->placeAutocompleteHelper->render($autocomplete),
            $this->renderApi([$autocomplete]),
        ]));

        try {
            $this->waitUntil(function () use ($autocomplete) {
                try {
                    $this->assertObjectExists($autocomplete);

                    return true;
                } catch (Exception $e) {
                }
            }, 5000);
        } catch (Exception $e) {
        }

        $this->assertSame([], $this->log('browser'));
    }

    protected function assertAutocomplete(Autocomplete $autocomplete)
    {
        $this->assertContainer($autocomplete);
        $this->assertAutocompleteHtml($autocomplete);

        if ($autocomplete->hasBound()) {
            $this->assertBound($autocomplete, $autocomplete->getBound(), $autocomplete->getVariable().'.getBounds()');
        }

        if ($autocomplete->hasLibraries()) {
            $this->assertLibraries($autocomplete->getLibraries());
        }
    }

    protected function assertAutocompleteHtml(Autocomplete $autocomplete)
    {
        $html = $this->byId();

        foreach ($autocomplete->getInputAttributes() as $attribute => $value) {
            $this->assertSame($value, $html->attribute($attribute));
        }

        $this->assertSame((string) $autocomplete->getValue(), $html->value());
    }

    protected function assertContainer(Autocomplete $autocomplete)
    {
        foreach ($this->getContainerPropertyPaths() as $propertyPath) {
            $this->assertContainerVariableExists($autocomplete, $propertyPath);
        }

        $this->assertSameContainerVariable($autocomplete, 'autocomplete');
    }

    /**
     * @return PlaceAutocompleteHelper
     */
    protected function createPlaceAutocompleteHelper()
    {
        return PlaceAutocompleteHelperBuilder::create()->build();
    }

    /**
     * @return string[]
     */
    private function getContainerPropertyPaths()
    {
        return [
            null,
            $base = 'base',
            $base.'.coordinates',
            $base.'.bounds',
            'autocomplete',
        ];
    }
}
