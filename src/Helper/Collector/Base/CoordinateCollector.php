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
    private ?BoundCollector $boundCollector = null;

    private ?CircleCollector $circleCollector = null;

    private ?InfoWindowCollector $infoWindowCollector = null;

    private ?MarkerCollector $markerCollector = null;

    private ?PolygonCollector $polygonCollector = null;

    private ?PolylineCollector $polylineCollector = null;

    private ?HeatmapLayerCollector $heatmapLayerCollector = null;

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

    public function getBoundCollector(): BoundCollector
    {
        return $this->boundCollector;
    }

    public function setBoundCollector(BoundCollector $boundCollector): void
    {
        $this->boundCollector = $boundCollector;
    }

    public function getCircleCollector(): CircleCollector
    {
        return $this->circleCollector;
    }

    public function setCircleCollector(CircleCollector $circleCollector): void
    {
        $this->circleCollector = $circleCollector;
    }

    public function getInfoWindowCollector(): InfoWindowCollector
    {
        return $this->infoWindowCollector;
    }

    public function setInfoWindowCollector(InfoWindowCollector $infoWindowCollector): void
    {
        $this->infoWindowCollector = $infoWindowCollector;
    }

    public function getMarkerCollector(): MarkerCollector
    {
        return $this->markerCollector;
    }

    public function setMarkerCollector(MarkerCollector $markerCollector): void
    {
        $this->markerCollector = $markerCollector;
    }

    public function getPolygonCollector(): PolygonCollector
    {
        return $this->polygonCollector;
    }

    public function setPolygonCollector(PolygonCollector $polygonCollector): void
    {
        $this->polygonCollector = $polygonCollector;
    }

    public function getPolylineCollector(): PolylineCollector
    {
        return $this->polylineCollector;
    }

    public function setPolylineCollector(PolylineCollector $polylineCollector): void
    {
        $this->polylineCollector = $polylineCollector;
    }

    public function getHeatmapLayerCollector(): HeatmapLayerCollector
    {
        return $this->heatmapLayerCollector;
    }

    public function setHeatmapLayerCollector(HeatmapLayerCollector $heatmapLayerCollector): void
    {
        $this->heatmapLayerCollector = $heatmapLayerCollector;
    }

    /**
     * @param Coordinate[] $coordinates
     * @return Coordinate[]
     */
    public function collect(Map $map, array $coordinates = []): array
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
