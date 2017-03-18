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

use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\Plugin\Scaler\Config\ConfigInterface;
use Ivory\GoogleMap\Service\Plugin\Scaler\Context\ContextInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceRadarSearchScaler extends Scaler
{
    /**
     * @param ContextInterface     $context
     * @param ConfigInterface|null $config
     */
    public function __construct(ContextInterface $context, ConfigInterface $config = null)
    {
        parent::__construct(PlaceSearchService::RADAR_URL, $context, $config);
    }
}
