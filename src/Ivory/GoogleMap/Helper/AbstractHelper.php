<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Map;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Abstract helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelper
{
    /** @var \Ivory\GoogleMap\Helper\Utils\JsonBuilder */
    protected $jsonBuilder;

    /**
     * Creates an helper.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    public function __construct(JsonBuilder $jsonBuilder = null)
    {
        if ($jsonBuilder === null) {
            $jsonBuilder = new JsonBuilder();
        }

        $this->setJsonBuilder($jsonBuilder);
    }

    /**
     * Gets the json builder.
     *
     * @return \Ivory\JsonBuilder\JsonBuilder The json builder.
     */
    public function getJsonBuilder()
    {
        return $this->jsonBuilder;
    }

    /**
     * Sets the json builder.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder)
    {
        $this->jsonBuilder = $jsonBuilder;
    }

    /**
     * Gets the javascript container name according to the map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The javascript container name.
     */
    protected function getJsContainerName(Map $map)
    {
        return $map->getJavascriptVariable().'_container';
    }
}
