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
    public const RAIL = 'RAIL';
    public const METRO_RAIL = 'METRO_RAIL';
    public const SUBWAY = 'SUBWAY';
    public const TRAM = 'TRAM';
    public const MONORAIL = 'MONORAIL';
    public const HEAVY_RAIL = 'HEAVY_RAIL';
    public const COMMUTER_TRAIN = 'COMPUTER_TRAIN';
    public const HIGH_SPEED_TRAIN = 'HIGH_SPEED_TRAIN';
    public const BUS = 'BUS';
    public const INTERCITY_BUS = 'INTERCITY_BUS';
    public const TROLLEYBUS = 'TROLLEYBUS';
    public const SHARE_TAXI = 'SHARE_TAXI';
    public const FERRY = 'FERRY';
    public const CABLE_CAR = 'CABLE_CAR';
    public const GONDOLA_LIFT = 'GONDOLA_LIFT';
    public const FUNICULAR = 'FUNICULAR';
    public const OTHER = 'OTHER';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
