<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Assets;

/**
 * Abstract variable asset.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractVariableAsset
{
    /** @var string */
    private $variable;

    /**
     * Creates a variable asset.
     *
     * @param string|null $prefix The variable prefix.
     */
    public function __construct($prefix = null)
    {
        $this->setVariable(str_replace('.', '', uniqid($prefix, true)));
    }

    /**
     * Gets the variable.
     *
     * @return string The variable.
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Sets the variable.
     *
     * @param string $variable The variable.
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    }
}
