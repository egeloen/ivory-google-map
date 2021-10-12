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

    private ?string $instance = null;

    private ?string $trigger = null;

    private ?string $handle = null;

    private ?bool $capture = null;

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

    public function getInstance(): string
    {
        return $this->instance;
    }

    /**
     * @param string $instance
     */
    public function setInstance($instance): void
    {
        $this->instance = $instance;
    }

    public function getTrigger(): string
    {
        return $this->trigger;
    }

    /**
     * @param string $trigger
     */
    public function setTrigger($trigger): void
    {
        $this->trigger = $trigger;
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     */
    public function setHandle($handle): void
    {
        $this->handle = $handle;
    }

    public function isCapture(): bool
    {
        return $this->capture;
    }

    /**
     * @param bool $capture
     */
    public function setCapture($capture): void
    {
        $this->capture = $capture;
    }
}
