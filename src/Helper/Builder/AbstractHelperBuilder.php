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

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelperBuilder
{
    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * @var JsonBuilder
     */
    private $jsonBuilder;

    /**
     * @var EventSubscriberInterface[]
     */
    private $subscribers = [];

    /**
     * @param Formatter|null   $formatter
     * @param JsonBuilder|null $jsonBuilder
     */
    public function __construct(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        $this->setFormatter($formatter ?: new Formatter());
        $this->setJsonBuilder($jsonBuilder ?: new JsonBuilder());
    }

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param Formatter $formatter
     *
     * @return $this
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * @return JsonBuilder
     */
    public function getJsonBuilder()
    {
        return $this->jsonBuilder;
    }

    /**
     * @param JsonBuilder $jsonBuilder
     *
     * @return $this
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder)
    {
        $this->jsonBuilder = $jsonBuilder;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSubscribers()
    {
        return !empty($this->subscribers);
    }

    /**
     * @return EventSubscriberInterface[]
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param EventSubscriberInterface[] $subscribers
     *
     * @return $this
     */
    public function setSubscribers(array $subscribers)
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
    public function addSubscribers(array $subscribers)
    {
        foreach ($subscribers as $subscriber) {
            $this->addSubscriber($subscriber);
        }

        return $this;
    }

    /**
     * @param EventSubscriberInterface $subscriber
     *
     * @return bool
     */
    public function hasSubscriber(EventSubscriberInterface $subscriber)
    {
        return in_array($subscriber, $this->subscribers, true);
    }

    /**
     * @param EventSubscriberInterface $subscriber
     *
     * @return $this
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        if (!$this->hasSubscriber($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    /**
     * @param EventSubscriberInterface $subscriber
     *
     * @return $this
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        unset($this->subscribers[array_search($subscriber, $this->subscribers, true)]);
        $this->subscribers = array_values($this->subscribers);

        return $this;
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function createEventDispatcher()
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
    protected function createSubscribers()
    {
        return $this->subscribers;
    }
}
