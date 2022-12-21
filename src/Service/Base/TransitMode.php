<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class TransitMode
{
    public const BUS = 'bud';
    public const SUBWAY = 'subway';
    public const TRAIN = 'train';
    public const TRAM = 'tram';
    public const RAIl = 'rail';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
