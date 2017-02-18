<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

use Ivory\GoogleMap\Map;
use Symfony\Component\EventDispatcher\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapEvent extends Event
{
    /**
     * @var Map
     */
    private $map;

    /**
     * @var mixed[]
     */
    private $parameters = [];

    /**
     * @param Map     $map
     * @param mixed[] $parameters
     */
    public function __construct(Map $map, array $parameters = [])
    {
        $this->map = $map;
        $this->setParameters($parameters);
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @return bool
     */
    public function hasParameters()
    {
        return !empty($this->parameters);
    }

    /**
     * @return mixed[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed[] $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = [];
        $this->addParameters($parameters);
    }

    /**
     * @param mixed[] $parameters
     */
    public function addParameters(array $parameters)
    {
        foreach ($parameters as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }
    }

    /**
     * @param string $parameter
     *
     * @return bool
     */
    public function hasParameter($parameter)
    {
        return isset($this->parameters[$parameter]);
    }

    /**
     * @param string $parameter
     *
     * @return mixed
     */
    public function getParameter($parameter)
    {
        return $this->hasParameter($parameter) ? $this->parameters[$parameter] : null;
    }

    /**
     * @param string $parameter
     * @param mixed  $value
     */
    public function setParameter($parameter, $value)
    {
        $this->parameters[$parameter] = $value;
    }

    /**
     * @param string $parameter
     */
    public function removeParameter($parameter)
    {
        unset($this->parameters[$parameter]);
    }
}
