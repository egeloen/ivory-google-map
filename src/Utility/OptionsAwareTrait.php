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
trait OptionsAwareTrait
{
    /**
     * @var mixed[]
     */
    private $options = [];

    /**
     * @return bool
     */
    public function hasOptions()
    {
        return !empty($this->options);
    }

    /**
     * @return mixed[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed[] $options
     */
    public function setOptions(array $options)
    {
        $this->options = [];
        $this->addOptions($options);
    }

    /**
     * @param mixed[] $options
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }
    }

    /**
     * @param string $option
     *
     * @return bool
     */
    public function hasOption($option)
    {
        return isset($this->options[$option]);
    }

    /**
     * @param string $option
     *
     * @return mixed
     */
    public function getOption($option)
    {
        return $this->hasOption($option) ? $this->options[$option] : null;
    }

    /**
     * @param string $option
     * @param mixed  $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }

    /**
     * @param string $option
     */
    public function removeOption($option)
    {
        unset($this->options[$option]);
    }
}
