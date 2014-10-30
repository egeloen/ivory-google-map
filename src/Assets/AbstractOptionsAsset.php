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
 * Abstract options asset.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOptionsAsset extends AbstractVariableAsset
{
    /** @var array */
    private $options = array();

    /**
     * Creates an options asset.
     *
     * @param string|null $prefix  The variable prefix.
     * @param array       $options The options.
     */
    public function __construct($prefix = null, array $options = array())
    {
        parent::__construct($prefix);

        $this->addOptions($options);
    }

    /**
     * Resets the options.
     */
    public function resetOptions()
    {
        $this->options = array();
    }

    /**
     * Checks if there are options.
     *
     * @return boolean TRUE if there are options else FALSE.
     */
    public function hasOptions()
    {
        return !empty($this->options);
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
        $this->resetOptions();
        $this->addOptions($options);
    }

    /**
     * Adds the options.
     *
     * @param array $options The options.
     */
    public function addOptions(array $options)
    {
        foreach ($options as $name => $value) {
            $this->setOption($name, $value);
        }
    }

    /**
     * Removes the options.
     *
     * @param array $names The option names.
     */
    public function removeOptions(array $names)
    {
        foreach ($names as $name) {
            $this->removeOption($name);
        }
    }

    /**
     * Checks if there is an option.
     *
     * @param string $name The option name.
     *
     * @return boolean TRUE if there is the option else FALSE.
     */
    public function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * Gets an option.
     *
     * @param string $name The option name.
     *
     * @return mixed The option value.
     */
    public function getOption($name)
    {
        return $this->hasOption($name) ? $this->options[$name] : null;
    }

    /**
     * Sets an option.
     *
     * @param string $name  The option name.
     * @param mixed  $value The option value.
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * Removes an option.
     *
     * @param string $name The option name.
     */
    public function removeOption($name)
    {
        unset($this->options[$name]);
    }
}
