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
    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $control;

    /**
     * @param string $position
     * @param string $control
     */
    public function __construct($position, $control)
    {
        $this->setPosition($position);
        $this->setControl($control);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getControl()
    {
        return $this->control;
    }

    /**
     * @param string $control
     */
    public function setControl($control)
    {
        $this->control = $control;
    }
}
