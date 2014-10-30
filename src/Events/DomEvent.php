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

/**
 * Dom event.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEvent extends Event
{
    /** @var boolean */
    private $capture;

    /**
     * Creates a dom event.
     *
     * @param string  $instance  The instance.
     * @param string  $eventName The event name.
     * @param string  $handle    The handle.
     * @param boolean $capture   TRUE if it is captured else FALSE.
     */
    public function __construct($instance, $eventName, $handle, $capture = false)
    {
        parent::__construct($instance, $eventName, $handle);

        $this->setCapture($capture);
    }

    /**
     * Checks if it is captured.
     *
     * @return boolean TRUE if it is captured else FALSE.
     */
    public function isCapture()
    {
        return $this->capture;
    }

    /**
     * Sets if it is captured.
     *
     * @param boolean $capture TRUE if it is captured else FALSE.
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }
}
