<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlaySubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_OVERLAY => [
                MapEvents::JAVASCRIPT_OVERLAY_ICON,
                MapEvents::JAVASCRIPT_OVERLAY_SYMBOL,
                MapEvents::JAVASCRIPT_OVERLAY_ICON_SEQUENCE,
                MapEvents::JAVASCRIPT_OVERLAY_CIRCLE,
                MapEvents::JAVASCRIPT_OVERLAY_ENCODED_POLYLINE,
                MapEvents::JAVASCRIPT_OVERLAY_GROUND_OVERLAY,
                MapEvents::JAVASCRIPT_OVERLAY_POLYGON,
                MapEvents::JAVASCRIPT_OVERLAY_POLYLINE,
                MapEvents::JAVASCRIPT_OVERLAY_RECTANGLE,
                MapEvents::JAVASCRIPT_OVERLAY_INFO_WINDOW,
                MapEvents::JAVASCRIPT_OVERLAY_MARKER_SHAPE,
                MapEvents::JAVASCRIPT_OVERLAY_MARKER,
                MapEvents::JAVASCRIPT_OVERLAY_MARKER_CLUSTER,
            ],
        ];
    }
}
