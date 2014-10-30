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

use Ivory\GoogleMap\Map;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Controls renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlsRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer */
    private $mapTypeControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer */
    private $overviewMapControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer */
    private $panControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer */
    private $rotateControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer */
    private $scaleControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer */
    private $streetViewControlRenderer;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer */
    private $zoomControlRenderer;

    /**
     * Creates a controls renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer|null     $mapTypeControlRenderer     The map type control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer|null $overviewMapControlRenderer The overview map control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer|null         $panControlRenderer         The pan control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer|null      $rotateControlRenderer      The rotate control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer|null       $scaleControlRenderer       The scale control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer|null  $streetViewControlRenderer  The street view control renderer.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer|null        $zoomControlRenderer        The zoom control renderer.
     */
    public function __construct(
        MapTypeControlRenderer $mapTypeControlRenderer = null,
        OverviewMapControlRenderer $overviewMapControlRenderer = null,
        PanControlRenderer $panControlRenderer = null,
        RotateControlRenderer $rotateControlRenderer = null,
        ScaleControlRenderer $scaleControlRenderer = null,
        StreetViewControlRenderer $streetViewControlRenderer = null,
        ZoomControlRenderer $zoomControlRenderer = null
    ) {
        $this->setMapTypeControlRenderer($mapTypeControlRenderer ?: new MapTypeControlRenderer());
        $this->setOverviewMapControlRenderer($overviewMapControlRenderer ?: new OverviewMapControlRenderer());
        $this->setPanControlRenderer($panControlRenderer ?: new PanControlRenderer());
        $this->setRotateControlRenderer($rotateControlRenderer ?: new RotateControlRenderer());
        $this->setScaleControlRenderer($scaleControlRenderer ?: new ScaleControlRenderer());
        $this->setStreetViewControlRenderer($streetViewControlRenderer ?: new StreetViewControlRenderer());
        $this->setZoomControlRenderer($zoomControlRenderer ?: new ZoomControlRenderer());
    }

    /**
     * Gets the map type control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer The map type control renderer.
     */
    public function getMapTypeControlRenderer()
    {
        return $this->mapTypeControlRenderer;
    }

    /**
     * Sets the map type control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\MapTypeControlRenderer $mapTypeControlRenderer The map type control renderer.
     */
    public function setMapTypeControlRenderer(MapTypeControlRenderer $mapTypeControlRenderer)
    {
        $this->mapTypeControlRenderer = $mapTypeControlRenderer;
    }

    /**
     * Gets the overview map control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer The overview map control renderer.
     */
    public function getOverviewMapControlRenderer()
    {
        return $this->overviewMapControlRenderer;
    }

    /**
     * Sets the overview map control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\OverviewMapControlRenderer $overviewMapControlRenderer The overview map control renderer.
     */
    public function setOverviewMapControlRenderer(OverviewMapControlRenderer $overviewMapControlRenderer)
    {
        $this->overviewMapControlRenderer = $overviewMapControlRenderer;
    }

    /**
     * Gets the pan control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer The pan control renderer.
     */
    public function getPanControlRenderer()
    {
        return $this->panControlRenderer;
    }

    /**
     * Sets the pan control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\PanControlRenderer $panControlRenderer The pan control renderer.
     */
    public function setPanControlRenderer(PanControlRenderer $panControlRenderer)
    {
        $this->panControlRenderer = $panControlRenderer;
    }

    /**
     * Gets the rotate control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer The rotate control renderer.
     */
    public function getRotateControlRenderer()
    {
        return $this->rotateControlRenderer;
    }

    /**
     * Sets the rotate control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\RotateControlRenderer $rotateControlRenderer The rotate control renderer.
     */
    public function setRotateControlRenderer(RotateControlRenderer $rotateControlRenderer)
    {
        $this->rotateControlRenderer = $rotateControlRenderer;
    }

    /**
     * Gets the scale control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer The scale control renderer.
     */
    public function getScaleControlRenderer()
    {
        return $this->scaleControlRenderer;
    }

    /**
     * Sets the scale control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ScaleControlRenderer $scaleControlRenderer The scale control renderer.
     */
    public function setScaleControlRenderer(ScaleControlRenderer $scaleControlRenderer)
    {
        $this->scaleControlRenderer = $scaleControlRenderer;
    }

    /**
     * Gets the street view control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer The street view control renderer.
     */
    public function getStreetViewControlRenderer()
    {
        return $this->streetViewControlRenderer;
    }

    /**
     * Sets the street view control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\StreetViewControlRenderer $streetViewControlRenderer The street view control renderer.
     */
    public function setStreetViewControlRenderer(StreetViewControlRenderer $streetViewControlRenderer)
    {
        $this->streetViewControlRenderer = $streetViewControlRenderer;
    }

    /**
     * Gets the zoom control renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer The zoom control renderer.
     */
    public function getZoomControlRenderer()
    {
        return $this->zoomControlRenderer;
    }

    /**
     * Sets the zoom control renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Controls\ZoomControlRenderer $zoomControlRenderer The zoom control renderer.
     */
    public function setZoomControlRenderer(ZoomControlRenderer $zoomControlRenderer)
    {
        $this->zoomControlRenderer = $zoomControlRenderer;
    }

    /**
     * Renders a controls.
     *
     * @param \Ivory\GoogleMap\Map           $map         The map.
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    public function render(Map $map, JsonBuilder $jsonBuilder)
    {
        $controls = array(
            'MapTypeControl',
            'OverviewMapControl',
            'PanControl',
            'RotateControl',
            'ScaleControl',
            'StreetViewControl',
            'ZoomControl',
        );

        foreach ($controls as $control) {
            $this->renderControl($control, $map, $jsonBuilder);
        }
    }

    /**
     * Renders a control.
     *
     * @param string                         $control     The control.
     * @param \Ivory\GoogleMap\Map           $map         The map.
     * @param \Ivory\JsonBuilder\JsonBuilder $jsonBuilder The json builder.
     */
    private function renderControl($control, Map $map, JsonBuilder $jsonBuilder)
    {
        $controlProperty = lcfirst($control);
        $hasControlProperty = $map->hasMapOption($controlProperty);
        $hasControl = $map->getControls()->{'has'.$control}();

        if (!$hasControlProperty && !$hasControl) {
            return;
        }

        $jsonBuilder->setValue(
            sprintf('[%s]', $controlProperty),
            ($hasControlProperty && $map->getMapOption($controlProperty)) || $hasControl
        );

        if ($hasControl) {
            $jsonBuilder->setValue(
                sprintf('[%sOptions]', $controlProperty),
                $this->{$controlProperty.'Renderer'}->render($map->getControls()->{'get'.$control}()),
                false
            );
        }
    }
}
