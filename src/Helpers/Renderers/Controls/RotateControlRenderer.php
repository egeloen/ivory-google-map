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

use Ivory\GoogleMap\Controls\RotateControl;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Rotate control renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer */
    private $controlPositionRenderer;

    /**
     * Creates a rotate control renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                                      $jsonBuilder             The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer|null $controlPositionRenderer The control position renderer.
     */
    public function __construct(
        JsonBuilder $jsonBuilder = null,
        ControlPositionRenderer $controlPositionRenderer = null
    ) {
        parent::__construct($jsonBuilder);

        $this->setControlPositionRenderer($controlPositionRenderer ?: new ControlPositionRenderer());
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
     * Renders a rotate control.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl $rotateControl The rotate control.
     *
     * @return string The rendered rotate control.
     */
    public function render(RotateControl $rotateControl)
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue(
                '[position]',
                $this->controlPositionRenderer->render($rotateControl->getControlPosition()),
                false
            )
            ->build();
    }
}
