<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Image;

use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class KeySubscriber implements EventSubscriberInterface
{
    private ?string $key;

    /**
     * @param string|null $key
     */
    public function __construct($key = null)
    {
        $this->key = $key;
    }

    public function handleMap(StaticMapEvent $event): void
    {
        if ($this->key !== null) {
            $event->setParameter('key', $this->key);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [StaticMapEvents::KEY => 'handleMap'];
    }
}
