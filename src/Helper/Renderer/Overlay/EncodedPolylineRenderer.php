<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Geometry\EncodingRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRenderer extends AbstractJsonRenderer
{
    /**
     * @var EncodingRenderer
     */
    private $encodingRenderer;

    /**
     * @param Formatter        $formatter
     * @param JsonBuilder      $jsonBuilder
     * @param EncodingRenderer $encodingRenderer
     */
    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        EncodingRenderer $encodingRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setEncodingRenderer($encodingRenderer);
    }

    /**
     * @return EncodingRenderer
     */
    public function getEncodingRenderer()
    {
        return $this->encodingRenderer;
    }

    /**
     * @param EncodingRenderer $encodingRenderer
     */
    public function setEncodingRenderer(EncodingRenderer $encodingRenderer)
    {
        $this->encodingRenderer = $encodingRenderer;
    }

    /**
     * @param EncodedPolyline $encodedPolyline
     * @param Map             $map
     *
     * @return string
     */
    public function render(EncodedPolyline $encodedPolyline, Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[path]', $this->encodingRenderer->renderDecodePath($encodedPolyline->getValue()), false)
            ->setValues($encodedPolyline->getOptions());

        return $formatter->renderObjectAssignment($encodedPolyline, $formatter->renderObject('Polyline', [
            $jsonBuilder->build(),
        ]));
    }
}
