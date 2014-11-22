<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Events;

use Ivory\GoogleMap\Assets\AbstractVariableAsset;

/**
 * Event.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event extends AbstractVariableAsset
{
    /** @var string */
    private $instance;

    /** @var string */
    private $eventName;

    /** @var string */
    private $handle;

    /**
     * Creates an event.
     *
     * @param string $instance  The instance.
     * @param string $eventName The event name.
     * @param string $handle    The handle.
     */
    public function __construct($instance, $eventName, $handle)
    {
        parent::__construct('event_');

        $this->setInstance($instance);
        $this->setEventName($eventName);
        $this->setHandle($handle);
    }

    /**
     * Gets the instance.
     *
     * @return string The instance.
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Sets the instance.
     *
     * @param string $instance The instance.
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * Gets the event name.
     *
     * @return string The event name.
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Sets the event name.
     *
     * @param string $eventName The event name.
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * Gets the handle.
     *
     * @return string The handle.
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Sets the handle.
     *
     * @param string $handle The handle.
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }
}
