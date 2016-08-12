<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Collector\Place\AutocompleteBoundCollector;
use Ivory\GoogleMap\Helper\Collector\Place\AutocompleteCoordinateCollector;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Helper\Renderer\Base\BoundRenderer;
use Ivory\GoogleMap\Helper\Renderer\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\JavascriptTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteContainerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteHtmlRenderer;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\CallbackRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Helper\Subscriber\Place\AutocompleteContainerSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\AutocompleteHtmlSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\AutocompleteInitSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\AutocompleteJavascriptSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\AutocompleteSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\Base\AutocompleteBaseSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\Base\AutocompleteBoundSubscriber;
use Ivory\GoogleMap\Helper\Subscriber\Place\Base\AutocompleteCoordinateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelperBuilder extends AbstractHelperBuilder
{
    /**
     * @return PlaceAutocompleteHelper
     */
    public function build()
    {
        return new PlaceAutocompleteHelper($this->createEventDispatcher());
    }

    /**
     * {@inheritdoc}
     */
    protected function createSubscribers()
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        // Base collectors
        $boundCollector = new AutocompleteBoundCollector();
        $coordinateCollector = new AutocompleteCoordinateCollector($boundCollector);

        // Base renderers
        $coordinateRenderer = new CoordinateRenderer($formatter);
        $boundRenderer = new BoundRenderer($formatter);

        // Html renderers
        $tagRenderer = new TagRenderer($formatter);
        $autocompleteHtmlRenderer = new AutocompleteHtmlRenderer($formatter, $tagRenderer);
        $javascriptTagRenderer = new JavascriptTagRenderer($formatter, $tagRenderer);

        // Utility renderers
        $callbackRenderer = new CallbackRenderer($formatter);
        $requirementRenderer = new RequirementRenderer($formatter);

        // Autocomplete renderers
        $autocompleteContainerRenderer = new AutocompleteContainerRenderer($formatter, $jsonBuilder);
        $autocompleteRenderer = new AutocompleteRenderer($formatter, $jsonBuilder, $requirementRenderer);

        return array_merge([
            new AutocompleteBaseSubscriber($formatter),
            new AutocompleteContainerSubscriber($formatter, $autocompleteContainerRenderer),
            new AutocompleteCoordinateSubscriber($formatter, $coordinateCollector, $coordinateRenderer),
            new AutocompleteBoundSubscriber($formatter, $boundCollector, $boundRenderer),
            new AutocompleteHtmlSubscriber($formatter, $autocompleteHtmlRenderer),
            new AutocompleteInitSubscriber($formatter),
            new AutocompleteJavascriptSubscriber(
                $formatter,
                $autocompleteRenderer,
                $callbackRenderer,
                $javascriptTagRenderer
            ),
            new AutocompleteSubscriber($formatter, $autocompleteRenderer),
        ], parent::createSubscribers());
    }
}
