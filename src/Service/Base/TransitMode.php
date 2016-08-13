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
    const BUS = 'bud';
    const SUBWAY = 'subway';
    const TRAIN = 'train';
    const TRAM = 'tram';
    const RAIl = 'rail';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
