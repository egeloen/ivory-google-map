<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Symfony\Component\EventDispatcher\Event;

/**
 * Abstract event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractEvent extends Event
{
    /** @var string|null */
    private $code;

    /**
     * Gets the code.
     *
     * @return string|null The code.
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the code.
     *
     * @param string $code The code.
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Adds a code.
     *
     * @param string $code The code.
     */
    public function addCode($code)
    {
        $this->code .= $code;
    }
}
