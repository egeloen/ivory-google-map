<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class AspectRatingType
{
    const APPEAL = 'appeal';
    const ATMOSPHERE = 'atmosphere';
    const DECOR = 'decor';
    const FACILITIES = 'facilities';
    const FOOD = 'food';
    const OVERALL = 'overall';
    const QUALITY = 'quality';
    const SERVICE = 'service';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
