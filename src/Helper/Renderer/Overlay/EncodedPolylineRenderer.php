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
use Validaide\Common\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRenderer extends AbstractJsonRenderer
{
    private ?EncodingRenderer $encodingRenderer = null;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        EncodingRenderer $encodingRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setEncodingRenderer($encodingRenderer);
    }

    public function getEncodingRenderer(): EncodingRenderer
    {
        return $this->encodingRenderer;
    }

    public function setEncodingRenderer(EncodingRenderer $encodingRenderer): void
    {
        $this->encodingRenderer = $encodingRenderer;
    }

    public function render(EncodedPolyline $encodedPolyline, Map $map): string
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
