<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer;
use Ivory\GoogleMap\MapTypeId;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Map renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer */
    private $mapTypeIdRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer */
    private $controlsRenderer;

    /**
     * Creates a map renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                               $jsonBuilder       The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\MapTypeIdRenderer|null         $mapTypeIdRenderer The map type id renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer|null $controlsRenderer  The controls renderer.
     */
    public function __construct(
        JsonBuilder $jsonBuilder = null,
        MapTypeIdRenderer $mapTypeIdRenderer = null,
        ControlsRenderer $controlsRenderer = null
    ) {
        parent::__construct($jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer ?: new MapTypeIdRenderer());
        $this->setControlsRenderer($controlsRenderer ?: new ControlsRenderer());
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
     * Gets the controls renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer The controls renderer.
     */
    public function getControlsRenderer()
    {
        return $this->controlsRenderer;
    }

    /**
     * Sets the controls renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ControlsRenderer $controlsRenderer The controls renderer.
     */
    public function setControlsRenderer(ControlsRenderer $controlsRenderer)
    {
        $this->controlsRenderer = $controlsRenderer;
    }

    /**
     * Renders a map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The rendered map.
     */
    public function render(Map $map)
    {
        $jsonBuilder = clone $this->getJsonBuilder();
        $jsonBuilder
            ->reset()
            ->setValues(array_merge(array('zoom' => 3), $map->getMapOptions()))
            ->setValue(
                '[mapTypeId]',
                $this->mapTypeIdRenderer->render($map->getMapOption('mapTypeId') ?: MapTypeId::ROADMAP),
                false
            );

        if ($map->getOverlays()->isAutoZoom()) {
            $jsonBuilder->removeValue('[zoom]');
        }

        $this->controlsRenderer->render($map, $jsonBuilder);

        return sprintf(
            'new google.maps.Map(document.getElementById("%s"),%s)',
            $map->getHtmlContainerId(),
            $jsonBuilder->build()
        );
    }
}
