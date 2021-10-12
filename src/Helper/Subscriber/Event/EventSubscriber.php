<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Event;

use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventSubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents(): array
    {
        return [
            MapEvents::JAVASCRIPT_EVENT => [
                MapEvents::JAVASCRIPT_EVENT_DOM_EVENT,
                MapEvents::JAVASCRIPT_EVENT_DOM_EVENT_ONCE,
                MapEvents::JAVASCRIPT_EVENT_EVENT,
                MapEvents::JAVASCRIPT_EVENT_EVENT_ONCE,
            ],
        ];
    }
}
