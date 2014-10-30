<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers;

use Ivory\JsonBuilder\JsonBuilder;

/**
 * Abstract json renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJsonRenderer
{
    /** @var \Ivory\JsonBuilder\JsonBuilder */
    private $jsonBuilder;

    /**
     * Creates an abstract json renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null $jsonBuilder The json builder.
     */
    public function __construct(JsonBuilder $jsonBuilder = null)
    {
        $this->setJsonBuilder($jsonBuilder ?: new JsonBuilder());
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
}
