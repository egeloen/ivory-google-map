<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class PlaceAutocompleteEvents
{
    const HTML = 'place_autocomplete.renderHtml';
    const JAVASCRIPT = 'place_autocomplete.javascript';
    const JAVASCRIPT_INIT = 'place_autocomplete.javascript.init';
    const JAVASCRIPT_INIT_CONTAINER = 'place_autocomplete.javascript.init.container';
    const JAVASCRIPT_BASE = 'place_autocomplete.javascript.base';
    const JAVASCRIPT_BASE_COORDINATE = 'place_autocomplete.javascript.base.coordinate';
    const JAVASCRIPT_BASE_BOUND = 'place_autocomplete.javascript.base.bound';
    const JAVASCRIPT_AUTOCOMPLETE = 'place_autocomplete.javascript.autocomplete';
    const JAVASCRIPT_EVENT = 'place_autocomplete.javascript.event';
    const JAVASCRIPT_EVENT_DOM_EVENT = 'place_autocomplete.javascript.event.dom_event';
    const JAVASCRIPT_EVENT_DOM_EVENT_ONCE = 'place_autocomplete.javascript.event.dom_event_once';
    const JAVASCRIPT_EVENT_EVENT = 'place_autocomplete.javascript.event.event';
    const JAVASCRIPT_EVENT_EVENT_ONCE = 'place_autocomplete.javascript.event.event_once';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
