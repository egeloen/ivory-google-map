<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Builder;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelperBuilder
{
    /**
     * @var EventSubscriberInterface[]
     */
    private array $subscribers = [];

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    public function hasSubscribers(): bool
    {
        return !empty($this->subscribers);
    }

    /**
     * @return EventSubscriberInterface[]
     */
    public function getSubscribers(): array
    {
        return $this->subscribers;
    }

    /**
     * @param EventSubscriberInterface[] $subscribers
     *
     * @return $this
     */
    public function setSubscribers(array $subscribers): self
    {
        $this->subscribers = [];
        $this->addSubscribers($subscribers);

        return $this;
    }

    /**
     * @param EventSubscriberInterface[] $subscribers
     *
     * @return $this
     */
    public function addSubscribers(array $subscribers): self
    {
        foreach ($subscribers as $subscriber) {
            $this->addSubscriber($subscriber);
        }

        return $this;
    }

    public function hasSubscriber(EventSubscriberInterface $subscriber): bool
    {
        return in_array($subscriber, $this->subscribers, true);
    }

    /**
     * @return $this
     */
    public function addSubscriber(EventSubscriberInterface $subscriber): self
    {
        if (!$this->hasSubscriber($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber): self
    {
        unset($this->subscribers[array_search($subscriber, $this->subscribers, true)]);
        $this->subscribers = empty($this->subscribers) ? [] : array_values($this->subscribers);

        return $this;
    }

    protected function createEventDispatcher(): EventDispatcher
    {
        $eventDispatcher = new EventDispatcher();

        foreach ($this->createSubscribers() as $subscriber) {
            $eventDispatcher->addSubscriber($subscriber);
        }

        return $eventDispatcher;
    }

    /**
     * @return EventSubscriberInterface[]
     */
    protected function createSubscribers(): array
    {
        return $this->subscribers;
    }
}
