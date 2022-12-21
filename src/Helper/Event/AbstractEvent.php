<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractEvent extends Event
{
    private string $code = '';

    public function hasCode(): bool
    {
        return !empty($this->code);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @param string $code
     */
    public function addCode($code)
    {
        $this->code .= $code;
    }
}
