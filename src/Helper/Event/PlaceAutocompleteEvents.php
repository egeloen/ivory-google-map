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
    public const HTML = 'place_autocomplete.renderHtml';
    public const JAVASCRIPT = 'place_autocomplete.javascript';
    public const JAVASCRIPT_INIT = 'place_autocomplete.javascript.init';
    public const JAVASCRIPT_INIT_CONTAINER = 'place_autocomplete.javascript.init.container';
    public const JAVASCRIPT_BASE = 'place_autocomplete.javascript.base';
    public const JAVASCRIPT_BASE_COORDINATE = 'place_autocomplete.javascript.base.coordinate';
    public const JAVASCRIPT_BASE_BOUND = 'place_autocomplete.javascript.base.bound';
    public const JAVASCRIPT_AUTOCOMPLETE = 'place_autocomplete.javascript.autocomplete';
    public const JAVASCRIPT_EVENT = 'place_autocomplete.javascript.event';
    public const JAVASCRIPT_EVENT_DOM_EVENT = 'place_autocomplete.javascript.event.dom_event';
    public const JAVASCRIPT_EVENT_DOM_EVENT_ONCE = 'place_autocomplete.javascript.event.dom_event_once';
    public const JAVASCRIPT_EVENT_EVENT = 'place_autocomplete.javascript.event.event';
    public const JAVASCRIPT_EVENT_EVENT_ONCE = 'place_autocomplete.javascript.event.event_once';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
