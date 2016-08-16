<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Helper\Collector\Layer\HeatmapLayerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\CircleCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolygonCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\PolylineCollector;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateCollector extends AbstractCollector
{
    /**
     * @var BoundCollector
     */
    private $boundCollector;

    /**
     * @var CircleCollector
     */
    private $circleCollector;

    /**
     * @var InfoWindowCollector
     */
    private $infoWindowCollector;

    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * @var PolygonCollector
     */
    private $polygonCollector;

    /**
     * @var PolylineCollector
     */
    private $polylineCollector;

    /**
     * @var HeatmapLayerCollector
     */
    private $heatmapLayerCollector;

    /**
     * @param BoundCollector        $boundCollector
     * @param CircleCollector       $circleCollector
     * @param InfoWindowCollector   $infoWindowCollector
     * @param MarkerCollector       $markerCollector
     * @param PolygonCollector      $polygonCollector
     * @param PolylineCollector     $polylineCollector
     * @param HeatmapLayerCollector $heatmapLayerCollector
     */
    public function __construct(
        BoundCollector $boundCollector,
        CircleCollector $circleCollector,
        InfoWindowCollector $infoWindowCollector,
        MarkerCollector $markerCollector,
        PolygonCollector $polygonCollector,
        PolylineCollector $polylineCollector,
        HeatmapLayerCollector $heatmapLayerCollector
    ) {
        $this->setBoundCollector($boundCollector);
        $this->setCircleCollector($circleCollector);
        $this->setInfoWindowCollector($infoWindowCollector);
        $this->setMarkerCollector($markerCollector);
        $this->setPolygonCollector($polygonCollector);
        $this->setPolylineCollector($polylineCollector);
        $this->setHeatmapLayerCollector($heatmapLayerCollector);
    }

    /**
     * @return BoundCollector
     */
    public function getBoundCollector()
    {
        return $this->boundCollector;
    }

    /**
     * @param BoundCollector $boundCollector
     */
    public function setBoundCollector(BoundCollector $boundCollector)
    {
        $this->boundCollector = $boundCollector;
    }

    /**
     * @return CircleCollector
     */
    public function getCircleCollector()
    {
        return $this->circleCollector;
    }

    /**
     * @param CircleCollector $circleCollector
     */
    public function setCircleCollector(CircleCollector $circleCollector)
    {
        $this->circleCollector = $circleCollector;
    }

    /**
     * @return InfoWindowCollector
     */
    public function getInfoWindowCollector()
    {
        return $this->infoWindowCollector;
    }

    /**
     * @param InfoWindowCollector $infoWindowCollector
     */
    public function setInfoWindowCollector(InfoWindowCollector $infoWindowCollector)
    {
        $this->infoWindowCollector = $infoWindowCollector;
    }

    /**
     * @return MarkerCollector
     */
    public function getMarkerCollector()
    {
        return $this->markerCollector;
    }

    /**
     * @param MarkerCollector $markerCollector
     */
    public function setMarkerCollector(MarkerCollector $markerCollector)
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @return PolygonCollector
     */
    public function getPolygonCollector()
    {
        return $this->polygonCollector;
    }

    /**
     * @param PolygonCollector $polygonCollector
     */
    public function setPolygonCollector(PolygonCollector $polygonCollector)
    {
        $this->polygonCollector = $polygonCollector;
    }

    /**
     * @return PolylineCollector
     */
    public function getPolylineCollector()
    {
        return $this->polylineCollector;
    }

    /**
     * @param PolylineCollector $polylineCollector
     */
    public function setPolylineCollector(PolylineCollector $polylineCollector)
    {
        $this->polylineCollector = $polylineCollector;
    }

    /**
     * @return HeatmapLayerCollector
     */
    public function getHeatmapLayerCollector()
    {
        return $this->heatmapLayerCollector;
    }

    /**
     * @param HeatmapLayerCollector $heatmapLayerCollector
     */
    public function setHeatmapLayerCollector(HeatmapLayerCollector $heatmapLayerCollector)
    {
        $this->heatmapLayerCollector = $heatmapLayerCollector;
    }

    /**
     * @param Map          $map
     * @param Coordinate[] $coordinates
     *
     * @return Coordinate[]
     */
    public function collect(Map $map, array $coordinates = [])
    {
        if (!$map->isAutoZoom()) {
            $coordinates = $this->collectValue($map->getCenter(), $coordinates);
        }

        foreach ($this->boundCollector->collect($map) as $bound) {
            if ($bound->hasCoordinates()) {
                $coordinates = $this->collectValue($bound->getSouthWest(), $coordinates);
                $coordinates = $this->collectValue($bound->getNorthEast(), $coordinates);
            }
        }

        foreach ($this->circleCollector->collect($map) as $circle) {
            $coordinates = $this->collectValue($circle->getCenter(), $coordinates);
        }

        foreach ($this->infoWindowCollector->collect($map) as $infoWindow) {
            if ($infoWindow->hasPosition()) {
                $coordinates = $this->collectValue($infoWindow->getPosition(), $coordinates);
            }
        }

        foreach ($this->markerCollector->collect($map) as $marker) {
            $coordinates = $this->collectValue($marker->getPosition(), $coordinates);
        }

        foreach ($this->polygonCollector->collect($map) as $polygon) {
            $coordinates = $this->collectValues($polygon->getCoordinates(), $coordinates);
        }

        foreach ($this->polylineCollector->collect($map) as $polyline) {
            $coordinates = $this->collectValues($polyline->getCoordinates(), $coordinates);
        }

        foreach ($this->heatmapLayerCollector->collect($map) as $heatmapLayer) {
            $coordinates = $this->collectValues($heatmapLayer->getCoordinates(), $coordinates);
        }

        return $coordinates;
    }
}
