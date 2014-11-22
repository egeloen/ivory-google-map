<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Controls;

use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Scale control renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControleStyleRenderer */
    private $scaleControlStyleRenderer;

    /**
     * Creates a scale control renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                                         $jsonBuilder               The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControleStyleRenderer|null $scaleControlStyleRenderer The scale control style renderer.
     */
    public function __construct(
        JsonBuilder $jsonBuilder = null,
        ScaleControlStyleRenderer $scaleControlStyleRenderer = null
    ) {
        parent::__construct($jsonBuilder);

        $this->setScaleControlStyleRenderer($scaleControlStyleRenderer ?: new ScaleControlStyleRenderer());
    }

    /**
     * Gets the scale control style renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer The scale control style renderer.
     */
    public function getScaleControlStyleRenderer()
    {
        return $this->scaleControlStyleRenderer;
    }

    /**
     * Sets the scale control style renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlStyleRenderer $scaleControlStyleRenderer The scale control style renderer.
     */
    public function setScaleControlStyleRenderer(ScaleControlStyleRenderer $scaleControlStyleRenderer)
    {
        $this->scaleControlStyleRenderer = $scaleControlStyleRenderer;
    }

    /**
     * Renders a scale control.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl $scaleControl The scale control.
     *
     * @return string The rendered scale control.
     */
    public function render(ScaleControl $scaleControl)
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue(
                '[style]',
                $this->scaleControlStyleRenderer->render($scaleControl->getScaleControlStyle()),
                false
            )
            ->build();
    }
}
