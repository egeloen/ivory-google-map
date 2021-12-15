<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class FullscreenControl
{
    private ?string $position = null;

    /**
     * @param string $position
     */
    public function __construct($position = ControlPosition::RIGHT_TOP)
    {
        $this->setPosition($position);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }
}
