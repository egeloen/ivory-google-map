<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Base;

use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BaseSubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_BASE => [
                MapEvents::JAVASCRIPT_BASE_COORDINATE,
                MapEvents::JAVASCRIPT_BASE_BOUND,
                MapEvents::JAVASCRIPT_BASE_POINT,
                MapEvents::JAVASCRIPT_BASE_SIZE,
            ],
        ];
    }
}
