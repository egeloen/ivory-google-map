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

use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Map type control renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer */
    private $mapTypeIdRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer */
    private $controlPositionRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer */
    private $mapTypeControlStyleRenderer;

    /**
     * Creates a map type control renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                                          $jsonBuilder                 The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer|null                    $mapTypeIdRenderer           The map type id renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlPositionRenderer|null     $controlPositionRenderer     The control position renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer|null $mapTypeControlStyleRenderer The map type control style renderer.
     */
    public function __construct(
        JsonBuilder $jsonBuilder = null,
        MapTypeIdRenderer $mapTypeIdRenderer = null,
        ControlPositionRenderer $controlPositionRenderer = null,
        MapTypeControlStyleRenderer $mapTypeControlStyleRenderer = null
    ) {
        parent::__construct($jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer ?: new MapTypeIdRenderer());
        $this->setControlPositionRenderer($controlPositionRenderer ?: new ControlPositionRenderer());
        $this->setMapTypeControlStyleRenderer($mapTypeControlStyleRenderer ?: new MapTypeControlStyleRenderer());
    }

    /**
     * Gets the map type id renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer The map type id renderer.
     */
    public function getMapTypeIdRenderer()
    {
        return $this->mapTypeIdRenderer;
    }

    /**
     * Sets the map type id renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer $mapTypeIdRenderer The map type id renderer.
     */
    public function setMapTypeIdRenderer(MapTypeIdRenderer $mapTypeIdRenderer)
    {
        $this->mapTypeIdRenderer = $mapTypeIdRenderer;
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
     * Gets the map type control style renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer The map type control style renderer.
     */
    public function getMapTypeControlStyleRenderer()
    {
        return $this->mapTypeControlStyleRenderer;
    }

    /**
     * Sets the map type control style renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlStyleRenderer $mapTypeControlStyleRenderer The map type control style renderer.
     */
    public function setMapTypeControlStyleRenderer(MapTypeControlStyleRenderer $mapTypeControlStyleRenderer)
    {
        $this->mapTypeControlStyleRenderer = $mapTypeControlStyleRenderer;
    }

    /**
     * Renders a map type control.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl The map type control.
     *
     * @return string The rendered map type control.
     */
    public function render(MapTypeControl $mapTypeControl)
    {
        $this->getJsonBuilder()->reset();

        foreach ($mapTypeControl->getMapTypeIds() as $index => $mapTypeId) {
            $this->getJsonBuilder()->setValue(
                sprintf('[mapTypeIds][%d]', $index),
                $this->mapTypeIdRenderer->render($mapTypeId),
                false
            );
        }

        return $this->getJsonBuilder()
            ->setValue(
                '[position]',
                $this->controlPositionRenderer->render($mapTypeControl->getControlPosition()),
                false
            )
            ->setValue(
                '[style]',
                $this->mapTypeControlStyleRenderer->render($mapTypeControl->getMapTypeControlStyle()),
                false
            )
            ->build();
    }
}
