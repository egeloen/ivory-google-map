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
interface VariableAwareInterface
{
    /**
     * @return string
     */
    public function getVariable();

    /**
     * @param string $variable
     */
    public function setVariable($variable);
}
