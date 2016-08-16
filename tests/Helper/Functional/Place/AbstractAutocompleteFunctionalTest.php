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

use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractApiFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractAutocompleteFunctionalTest extends AbstractApiFunctionalTest
{
    /**
     * @var PlaceAutocompleteHelper
     */
    private $placeAutocompleteHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->placeAutocompleteHelper = $this->createPlaceAutocompleteHelper();
    }

    /**
     * @param Autocomplete $autocomplete
     * @param string|null  $html
     */
    protected function renderAutocomplete(Autocomplete $autocomplete, $html = null)
    {
        $this->renderHtml(implode('', [
            $html,
            $this->placeAutocompleteHelper->render($autocomplete),
            $this->renderApi([$autocomplete]),
        ]));

        $this->waitUntil(function () use ($autocomplete) {
            try {
                $this->assertObjectExists($autocomplete);

                return true;
            } catch (\Exception $e) {
            }
        }, 5000);
    }

    /**
     * @param Autocomplete $autocomplete
     */
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

    /**
     * @param Autocomplete $autocomplete
     */
    protected function assertAutocompleteHtml(Autocomplete $autocomplete)
    {
        $html = $this->byId($autocomplete->getHtmlId());

        foreach ($autocomplete->getInputAttributes() as $attribute => $value) {
            $this->assertSame($value, $html->attribute($attribute));
        }

        $this->assertSame((string) $autocomplete->getValue(), $html->value());
    }

    /**
     * @param Autocomplete $autocomplete
     */
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
