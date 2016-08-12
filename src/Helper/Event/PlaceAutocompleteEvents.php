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
    const HTML = 'autocomplete.renderHtml';
    const JAVASCRIPT = 'autocomplete.javascript';
    const JAVASCRIPT_INIT = 'autocomplete.javascript.init';
    const JAVASCRIPT_INIT_CONTAINER = 'autocomplete.javascript.init.container';
    const JAVASCRIPT_BASE = 'autocomplete.javascript.base';
    const JAVASCRIPT_BASE_COORDINATE = 'autocomplete.javascript.base.coordinate';
    const JAVASCRIPT_BASE_BOUND = 'autocomplete.javascript.base.bound';
    const JAVASCRIPT_AUTOCOMPLETE = 'autocomplete.javascript.autocomplete';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
