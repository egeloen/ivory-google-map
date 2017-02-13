<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class PlaceSearchRankBy
{
    const PROMINENCE = 'prominence';
    const DISTANCE = 'distance';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
