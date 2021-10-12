<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvents;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapInitSubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_INIT => [
                MapEvents::JAVASCRIPT_INIT_CONTAINER,
                MapEvents::JAVASCRIPT_INIT_FUNCTION,
            ],
        ];
    }
}
