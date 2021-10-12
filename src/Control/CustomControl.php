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
class CustomControl
{
    private ?string $position = null;

    private ?string $control = null;

    /**
     * @param string $position
     * @param string $control
     */
    public function __construct($position, $control)
    {
        $this->setPosition($position);
        $this->setControl($control);
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

    public function getControl(): string
    {
        return $this->control;
    }

    /**
     * @param string $control
     */
    public function setControl($control): void
    {
        $this->control = $control;
    }
}
