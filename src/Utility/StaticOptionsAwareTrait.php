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
trait StaticOptionsAwareTrait
{
    /**
     * @var mixed[]
     */
    private $staticOptions = [];

    /**
     * @return bool
     */
    public function hasStaticOptions()
    {
        return !empty($this->staticOptions);
    }

    /**
     * @return mixed[]
     */
    public function getStaticOptions()
    {
        return $this->staticOptions;
    }

    /**
     * @param mixed[] $options
     */
    public function setStaticOptions(array $options)
    {
        $this->staticOptions = [];
        $this->addStaticOptions($options);
    }

    /**
     * @param mixed[] $options
     */
    public function addStaticOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->setStaticOption($option, $value);
        }
    }

    /**
     * @param string $option
     *
     * @return bool
     */
    public function hasStaticOption($option)
    {
        return isset($this->staticOptions[$option]);
    }

    /**
     * @param string $option
     *
     * @return mixed
     */
    public function getStaticOption($option)
    {
        return $this->hasStaticOption($option) ? $this->staticOptions[$option] : null;
    }

    /**
     * @param string $option
     * @param mixed  $value
     */
    public function setStaticOption($option, $value)
    {
        $this->staticOptions[$option] = $value;
    }

    /**
     * @param string $option
     */
    public function removeStaticOption($option)
    {
        unset($this->staticOptions[$option]);
    }
}
