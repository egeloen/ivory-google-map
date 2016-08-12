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
            $this->variable = $this->generateVariable();
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

    /**
     * @param string $prefix
     */
    private function setVariablePrefix($prefix)
    {
        $this->variable = $this->generateVariable($prefix);
    }

    /**
     * @param string $prefix
     *
     * @return string
     */
    private function generateVariable($prefix = null)
    {
        return str_replace('.', '', uniqid($prefix, true));
    }
}
