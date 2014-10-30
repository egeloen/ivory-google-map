<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Encoded polyline renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer */
    private $encodingRenderer;

    /**
     * Creates an encoded polyline renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                               $jsonBuilder      The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer|null $encodingRenderer The encoding renderer.
     */
    public function __construct(JsonBuilder $jsonBuilder = null, EncodingRenderer $encodingRenderer = null)
    {
        parent::__construct($jsonBuilder);

        $this->setEncodingRenderer($encodingRenderer ?: new EncodingRenderer());
    }

    /**
     * Gets the encoding renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer The encoding renderer.
     */
    public function getEncodingRenderer()
    {
        return $this->encodingRenderer;
    }

    /**
     * Sets the encoding renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Geometry\EncodingRenderer $encodingRenderer The encoding renderer.
     */
    public function setEncodingRenderer(EncodingRenderer $encodingRenderer)
    {
        $this->encodingRenderer = $encodingRenderer;
    }

    /**
     * Renders an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     * @param \Ivory\GoogleMap\Map                      $map             The map.
     *
     * @return string The rendered encoded polyline.
     */
    public function render(EncodedPolyline $encodedPolyline, Map $map)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[map]', $map->getVariable(), false)
            ->setValue('[path]', $this->encodingRenderer->renderDecodePath($encodedPolyline->getValue()), false)
            ->setValues($encodedPolyline->getOptions());

        return sprintf('new google.maps.Polyline(%s)', $this->getJsonBuilder()->build());
    }
}
