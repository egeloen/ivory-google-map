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

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractDelegateSubscriber extends AbstractSubscriber implements DelegateSubscriberInterface
{
    /**
     * @param Event                    $event
     * @param string                   $eventName
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function handle(Event $event, $eventName, EventDispatcherInterface $eventDispatcher)
    {
        $delegates = static::getDelegatedSubscribedEvents();

        if (isset($delegates[$eventName])) {
            foreach ($delegates[$eventName] as $delegate) {
                $eventDispatcher->dispatch($delegate, $event);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        $events = [];

        foreach (array_keys(static::getDelegatedSubscribedEvents()) as $event) {
            $events[$event] = 'handle';
        }

        return $events;
    }
}
