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

use Symfony\Contracts\EventDispatcher\Event;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapEvent extends Event
{
    private Map $map;

    /**
     * @var mixed[]
     */
    private array $parameters = [];

    /**
     * @param mixed[] $parameters
     */
    public function __construct(Map $map, array $parameters = [])
    {
        $this->map = $map;
        $this->setParameters($parameters);
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function hasParameters(): bool
    {
        return !empty($this->parameters);
    }

    /**
     * @return mixed[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param mixed[] $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = [];
        $this->addParameters($parameters);
    }

    /**
     * @param mixed[] $parameters
     */
    public function addParameters(array $parameters): void
    {
        foreach ($parameters as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }
    }

    /**
     * @param string $parameter
     */
    public function hasParameter($parameter): bool
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
    public function setParameter($parameter, $value): void
    {
        $this->parameters[$parameter] = $value;
    }

    /**
     * @param string $parameter
     */
    public function removeParameter($parameter): void
    {
        unset($this->parameters[$parameter]);
    }
}
