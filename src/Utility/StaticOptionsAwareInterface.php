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
interface StaticOptionsAwareInterface
{
    /**
     * @return bool
     */
    public function hasStaticOptions();

    /**
     * @return mixed[]
     */
    public function getStaticOptions();

    /**
     * @param mixed[] $options
     */
    public function setStaticOptions(array $options);

    /**
     * @param mixed[] $options
     */
    public function addStaticOptions(array $options);

    /**
     * @param string $option
     *
     * @return bool
     */
    public function hasStaticOption($option);

    /**
     * @param string $option
     *
     * @return mixed
     */
    public function getStaticOption($option);

    /**
     * @param string $option
     * @param mixed  $value
     */
    public function setStaticOption($option, $value);

    /**
     * @param string $option
     */
    public function removeStaticOption($option);
}
