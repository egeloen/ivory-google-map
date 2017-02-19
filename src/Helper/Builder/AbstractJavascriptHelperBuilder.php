<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJavascriptHelperBuilder extends AbstractHelperBuilder
{
    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * @var JsonBuilder
     */
    private $jsonBuilder;

    /**
     * @param Formatter|null   $formatter
     * @param JsonBuilder|null $jsonBuilder
     */
    public function __construct(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        $this->setFormatter($formatter ?: new Formatter());
        $this->setJsonBuilder($jsonBuilder ?: new JsonBuilder());
    }

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param Formatter $formatter
     *
     * @return $this
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * @return JsonBuilder
     */
    public function getJsonBuilder()
    {
        return $this->jsonBuilder;
    }

    /**
     * @param JsonBuilder $jsonBuilder
     *
     * @return $this
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder)
    {
        $this->jsonBuilder = $jsonBuilder;

        return $this;
    }
}
