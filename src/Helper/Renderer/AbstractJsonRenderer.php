<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJsonRenderer extends AbstractRenderer
{
    /**
     * @var JsonBuilder
     */
    private $jsonBuilder;

    /**
     * @param Formatter   $formatter
     * @param JsonBuilder $jsonBuilder
     */
    public function __construct(Formatter $formatter, JsonBuilder $jsonBuilder)
    {
        parent::__construct($formatter);

        $this->setJsonBuilder($jsonBuilder);
    }

    /**
     * @return JsonBuilder
     */
    public function getJsonBuilder()
    {
        $jsonEncodeOptions = $this->jsonBuilder->getJsonEncodeOptions();

        if ($this->getFormatter()->isDebug()) {
            $jsonEncodeOptions |= JSON_PRETTY_PRINT;
        }

        $jsonBuilder = clone $this->jsonBuilder;

        return $jsonBuilder
            ->reset()
            ->setJsonEncodeOptions($jsonEncodeOptions);
    }

    /**
     * @param JsonBuilder $jsonBuilder
     */
    public function setJsonBuilder(JsonBuilder $jsonBuilder)
    {
        $this->jsonBuilder = $jsonBuilder;
    }
}
