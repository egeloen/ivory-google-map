<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Event;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $instance;

    /**
     * @var string
     */
    private $trigger;

    /**
     * @var string
     */
    private $handle;

    /**
     * @var bool
     */
    private $capture;

    /**
     * @param string $instance
     * @param string $trigger
     * @param string $handle
     * @param bool   $capture
     */
    public function __construct($instance, $trigger, $handle, $capture = false)
    {
        $this->setInstance($instance);
        $this->setTrigger($trigger);
        $this->setHandle($handle);
        $this->setCapture($capture);
    }

    /**
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param string $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param string $trigger
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;
    }

    /**
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return bool
     */
    public function isCapture()
    {
        return $this->capture;
    }

    /**
     * @param bool $capture
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }
}
