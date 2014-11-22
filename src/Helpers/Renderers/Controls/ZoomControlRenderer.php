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

use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Zoom control renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer */
    private $controlPositionRenderer;

    /** @var \vory\GoogleMap\Templating\Renderer\Controls\ZoomControlStyleRenderer */
    private $zoomControlStyleRenderer;

    /**
     * Create a zoom control renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                                       $jsonBuilder              The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer|null  $controlPositionRenderer  The control position renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer|null $zoomControlStyleRenderer The zoom control style renderer.
     */
    public function __construct(
        JsonBuilder $jsonBuilder = null,
        ControlPositionRenderer $controlPositionRenderer = null,
        ZoomControlStyleRenderer $zoomControlStyleRenderer = null
    ) {
        parent::__construct($jsonBuilder);

        $this->setControlPositionRenderer($controlPositionRenderer ?: new ControlPositionRenderer());
        $this->setZoomControlStyleRenderer($zoomControlStyleRenderer ?: new ZoomControlStyleRenderer());
    }

    /**
     * Gets the control position renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer The control position renderer.
     */
    public function getControlPositionRenderer()
    {
        return $this->controlPositionRenderer;
    }

    /**
     * Sets the control position renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer $controlPositionRenderer The control position renderer.
     */
    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer)
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    /**
     * Gets the zoom control style renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer The zoom control style renderer.
     */
    public function getZoomControlStyleRenderer()
    {
        return $this->zoomControlStyleRenderer;
    }

    /**
     * Sets the zoom control style renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlStyleRenderer $zoomControlStyleRenderer The zoom control style renderer.
     */
    public function setZoomControlStyleRenderer(ZoomControlStyleRenderer $zoomControlStyleRenderer)
    {
        $this->zoomControlStyleRenderer = $zoomControlStyleRenderer;
    }

    /**
     * Renders a zoom control.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl $zoomControl The zoom control.
     *
     * @return string The rendered zoom control.
     */
    public function render(ZoomControl $zoomControl)
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue('[position]', $this->controlPositionRenderer->render($zoomControl->getControlPosition()), false)
            ->setValue('[style]', $this->zoomControlStyleRenderer->render($zoomControl->getZoomControlStyle()), false)
            ->build();
    }
}
