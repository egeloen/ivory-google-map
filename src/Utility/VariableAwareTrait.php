<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Utility;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
trait VariableAwareTrait
{
    /**
     * @var string
     */
    private $variable;

    /**
     * @return string
     */
    public function getVariable()
    {
        if ($this->variable === null) {
            $prefix = strtolower(substr(strrchr(get_class($this), '\\'), 1));
            $this->variable = $prefix.substr_replace(uniqid(null, true), '', 14, 1);
        }

        return $this->variable;
    }

    /**
     * @param string $variable
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    }
}
