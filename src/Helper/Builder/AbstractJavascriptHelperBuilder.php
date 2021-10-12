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
    private ?Formatter $formatter = null;

    private ?JsonBuilder $jsonBuilder = null;

    /**
     * @param Formatter|null   $formatter
     * @param JsonBuilder|null $jsonBuilder
     */
    public function __construct(Formatter $formatter = null, JsonBuilder $jsonBuilder = null)
    {
        $this->setFormatter($formatter ?: new Formatter());
        $this->setJsonBuilder($jsonBuilder ?: new JsonBuilder());
    }

    public function getFormatter(): Formatter
    {
        return $this->formatter;
    }

    /**
     * @return $this
     */
    public function setFormatter(Formatter $formatter): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    public function getJsonBuilder(): JsonBuilder
    {
        return $this->jsonBuilder;
    }

    /**
     * @return $this
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder): self
    {
        $this->jsonBuilder = $jsonBuilder;

        return $this;
    }
}
