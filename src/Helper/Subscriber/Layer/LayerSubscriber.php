<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Layer;

use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerSubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_LAYER => [
                MapEvents::JAVASCRIPT_LAYER_GEO_JSON_LAYER,
                MapEvents::JAVASCRIPT_LAYER_HEATMAP_LAYER,
                MapEvents::JAVASCRIPT_LAYER_KML_LAYER,
            ],
        ];
    }
}
