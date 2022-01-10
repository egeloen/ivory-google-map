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
final class ApiEvents
{
    public const JAVASCRIPT              = 'api.javascript';
    public const JAVASCRIPT_MAP          = 'api.javascript.map';
    public const JAVASCRIPT_AUTOCOMPLETE = 'api.javascript.autocomplete';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
