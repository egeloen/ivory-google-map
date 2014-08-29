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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Exception\EventException;

/**
 * Event which describes a google map event.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $instance;

    /** @var string */
    protected $eventName;

    /** @var string */
    protected $handle;

    /** @var boolean */
    protected $capture;

    /**
     * Creates an event.
     *
     * @param string  $instance  The event object instance.
     * @param string  $eventName The event name.
     * @param string  $handle    The event function handle.
     * @param boolean $capture   The event capture.
     */
    public function __construct($instance = null, $eventName = null, $handle = null, $capture = false)
    {
        $this->setPrefixJavascriptVariable('event_');

        if ($instance !== null) {
            $this->setInstance($instance);
        }

        if ($eventName !== null) {
            $this->setEventName($eventName);
        }

        if ($handle !== null) {
            $this->setHandle($handle);
        }

        $this->setCapture($capture);
    }

    /**
     * Gets the event object instance.
     *
     * @return string The event object instance.
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Sets the event object instance.
     *
     * @param string $instance The event object instance.
     *
     * @throws \Ivory\GoogleMap\Exception\EventException If the instance is not valid.
     */
    public function setInstance($instance)
    {
        if (!is_string($instance)) {
            throw EventException::invalidInstance();
        }

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
     *
     * @throws \Ivory\GoogleMap\Exception\EventException If the event name is not valid.
     */
    public function setEventName($eventName)
    {
        if (!is_string($eventName)) {
            throw EventException::invalidEventName();
        }

        $this->eventName = $eventName;
    }

    /**
     * Gets the event function handle.
     *
     * @return string The event function handle.
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Sets the event function handle.
     *
     * @param string $handle The event function handle.
     *
     * @throws \Ivory\GoogleMap\Exception\EventException If the handle is not valid.
     */
    public function setHandle($handle)
    {
        if (!is_string($handle)) {
            throw EventException::invalidHandle();
        }

        $this->handle = $handle;
    }

    /**
     * Checks if the event is capture.
     *
     * @return boolean TRUE if the event is capture else FALSE.
     */
    public function isCapture()
    {
        return $this->capture;
    }

    /**
     * Sets if the event is capture.
     *
     * @param boolean $capture TRUE if the event is capture else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\EventException If the capture is not valid.
     */
    public function setCapture($capture)
    {
        if (!is_bool($capture)) {
            throw EventException::invalidCapture();
        }

        $this->capture = $capture;
    }
}
