<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class DirectionTransitVehicleType
{
    const RAIL = 'RAIL';
    const METRO_RAIL = 'METRO_RAIL';
    const SUBWAY = 'SUBWAY';
    const TRAM = 'TRAM';
    const MONORAIL = 'MONORAIL';
    const HEAVY_RAIL = 'HEAVY_RAIL';
    const COMMUTER_TRAIN = 'COMPUTER_TRAIN';
    const HIGH_SPEED_TRAIN = 'HIGH_SPEED_TRAIN';
    const BUS = 'BUS';
    const INTERCITY_BUS = 'INTERCITY_BUS';
    const TROLLEYBUS = 'TROLLEYBUS';
    const SHARE_TAXI = 'SHARE_TAXI';
    const FERRY = 'FERRY';
    const CABLE_CAR = 'CABLE_CAR';
    const GONDOLA_LIFT = 'GONDOLA_LIFT';
    const FUNICULAR = 'FUNICULAR';
    const OTHER = 'OTHER';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
