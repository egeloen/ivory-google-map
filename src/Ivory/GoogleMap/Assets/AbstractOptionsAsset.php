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
 * Allow easy add of options for any class model that requires it.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOptionsAsset extends AbstractJavascriptVariableAsset
{
    /** @var array */
    protected $options;

    /**
     * Creates an options asset.
     */
    public function __construct($javascriptVariable = null, array $options = array())
    {
        parent::__construct($javascriptVariable);

        $this->setOptions($options);
    }

    /**
     * Checks if there is option.
     *
     * @return boolean TRUE if there is option else FALSE.
     */
    public function hasOptions()
    {
        return !empty($this->options);
    }

    /**
     * Checks if the option exists.
     *
     * @param string $option The option.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the option is not valid.
     *
     * @return boolean TRUE if the option exists else FALSE.
     */
    public function hasOption($option)
    {
        if (!is_string($option)) {
            throw AssetException::invalidOption();
        }

        return isset($this->options[$option]);
    }

    /**
     * Gets the options.
     *
     * @return array The options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options.
     *
     * @param array $options The options.
     */
    public function setOptions(array $options)
    {
        $this->options = array();

        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }
    }

    /**
     * Gets a specific option.
     *
     * @param string $option The option.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the option does not exist.
     *
     * @return mixed The option value.
     */
    public function getOption($option)
    {
        if (!$this->hasOption($option)) {
            throw AssetException::optionDoesNotExist($option);
        }

        return $this->options[$option];
    }

    /**
     * Sets a specific option.
     *
     * @param string $option The option
     * @param mixed  $value  The option value.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the option is not valid.
     */
    public function setOption($option, $value)
    {
        if (!is_string($option)) {
            throw AssetException::invalidOption();
        }

        $this->options[$option] = $value;
    }

    /**
     * Removes an option.
     *
     * @param string $option The option.
     *
     * @throws \Ivory\GoogleMap\Exception\AssetException If the option does not exist.
     */
    public function removeOption($option)
    {
        if (!$this->hasOption($option)) {
            throw AssetException::optionDoesNotExist($option);
        }

        unset($this->options[$option]);
    }
}
