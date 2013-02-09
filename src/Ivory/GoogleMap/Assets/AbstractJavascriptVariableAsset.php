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

use Ivory\GoogleMap\Exception\AssetException;

/**
 * Allow easy generation of unique javascript variable for any class model that requires it.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $javascriptVariable;

    /**
     * Creates a javascript variable asset.
     */
    public function __construct($javascriptVariable = null)
    {
        if ($javascriptVariable === null) {
            $javascriptVariable = uniqid();
        }

        $this->setJavascriptVariable($javascriptVariable);
    }

    /**
     * Sets the prefix of the javascript variable.
     *
     * @param string $prefixJavascriptVariable The prefix of the javascript variable.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the prefix javascript variable is not valid.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        if (!is_string($prefixJavascriptVariable)) {
            throw AssetException::invalidPrefixJavascriptVariable();
        }

        $this->javascriptVariable = uniqid($prefixJavascriptVariable);
    }

    /**
     * Gets the javascript variable which describes the asset.
     *
     * @return string The javascript variable.
     */
    public function getJavascriptVariable()
    {
        return $this->javascriptVariable;
    }

    /**
     * Sets the javascript variable which describes the asset
     *
     * @param string $javascriptVariable The javascript variable.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the javascript variable is not valid.
     */
    public function setJavascriptVariable($javascriptVariable)
    {
        if (!is_string($javascriptVariable)) {
            throw AssetException::invalidJavascriptVariable();
        }

        $this->javascriptVariable = $javascriptVariable;
    }
}
