<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin\Scaler;

use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Place\Autocomplete\PlaceAutocompleteService;
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Plugin\Scaler\Config\ConfigInterface;
use Ivory\GoogleMap\Service\Plugin\Scaler\Config\SharedConfig;
use Ivory\GoogleMap\Service\Plugin\Scaler\Context\ContextInterface;
use Ivory\GoogleMap\Service\TimeZone\TimeZoneService;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SharedScaler extends Scaler
{
    /**
     * @param ContextInterface     $context
     * @param ConfigInterface|null $config
     */
    public function __construct(ContextInterface $context, ConfigInterface $config = null)
    {
        parent::__construct([
            DirectionService::URL,
            DistanceMatrixService::URL,
            ElevationService::URL,
            GeocoderService::URL,
            PlaceAutocompleteService::URL,
            PlaceDetailService::URL,
            PlaceSearchService::NEARBY_URL,
            PlaceSearchService::RADAR_URL,
            PlaceSearchService::TEXT_URL,
            TimeZoneService::URL,
        ], $context, $config ?: new SharedConfig());
    }
}
