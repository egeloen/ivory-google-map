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
    public const APPEAL = 'appeal';
    public const ATMOSPHERE = 'atmosphere';
    public const DECOR = 'decor';
    public const FACILITIES = 'facilities';
    public const FOOD = 'food';
    public const OVERALL = 'overall';
    public const QUALITY = 'quality';
    public const SERVICE = 'service';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
