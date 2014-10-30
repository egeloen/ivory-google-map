<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Aggregators\Base;

use Ivory\GoogleMap\Helpers\Aggregators\AbstractAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator;
use Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator;
use Ivory\GoogleMap\Map;

/**
 * Coordinate aggregator.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateAggregator extends AbstractAggregator
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator */
    private $circleAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator */
    private $infoWindowAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator */
    private $markerAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator */
    private $polygonAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator */
    private $polylineAggregator;

    /**
     * Creates a coordinate aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator|null          $boundAggregator      The bound aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator|null     $circleAggregator     The circle aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator|null $infoWindowAggregator The info window aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator|null     $markerAggregator     The marker aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator|null    $polygonAggregator    The polygon aggregator.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator|null   $polylineAggregator   The polyline aggregator.
     */
    public function __construct(
        BoundAggregator $boundAggregator = null,
        CircleAggregator $circleAggregator = null,
        InfoWindowAggregator $infoWindowAggregator = null,
        MarkerAggregator $markerAggregator = null,
        PolygonAggregator $polygonAggregator = null,
        PolylineAggregator $polylineAggregator = null
    ) {
        $this->setBoundAggregator($boundAggregator ?: new BoundAggregator());
        $this->setCircleAggregator($circleAggregator ?: new CircleAggregator());
        $this->setInfoWindowAggregator($infoWindowAggregator ?: new InfoWindowAggregator());
        $this->setMarkerAggregator($markerAggregator ?: new MarkerAggregator());
        $this->setPolygonAggregator($polygonAggregator ?: new PolygonAggregator());
        $this->setPolylineAggregator($polylineAggregator ?: new PolylineAggregator());
    }

    /**
     * Gets the bound aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator The bound aggregator.
     */
    public function getBoundAggregator()
    {
        return $this->boundAggregator;
    }

    /**
     * Sets the bound aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Base\BoundAggregator $boundAggregator The bound aggregator.
     */
    public function setBoundAggregator(BoundAggregator $boundAggregator)
    {
        $this->boundAggregator = $boundAggregator;
    }

    /**
     * Gets the circle aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator The circle aggregator.
     */
    public function getCircleAggregator()
    {
        return $this->circleAggregator;
    }

    /**
     * Sets the circle aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\CircleAggregator $circleAggregator The circle aggregator.
     */
    public function setCircleAggregator(CircleAggregator $circleAggregator)
    {
        $this->circleAggregator = $circleAggregator;
    }

    /**
     * Gets the info window aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator The info window aggregator.
     */
    public function getInfoWindowAggregator()
    {
        return $this->infoWindowAggregator;
    }

    /**
     * Sets the info window aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\InfoWindowAggregator $infoWindowAggregator The info window aggregator.
     */
    public function setInfoWindowAggregator(InfoWindowAggregator $infoWindowAggregator)
    {
        $this->infoWindowAggregator = $infoWindowAggregator;
    }

    /**
     * Gets the marker aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator The marker aggregator.
     */
    public function getMarkerAggregator()
    {
        return $this->markerAggregator;
    }

    /**
     * Sets the marker aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\MarkerAggregator $markerAggregator The marker aggregator.
     */
    public function setMarkerAggregator(MarkerAggregator $markerAggregator)
    {
        $this->markerAggregator = $markerAggregator;
    }

    /**
     * Gets the polygon aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator The polygon aggregator.
     */
    public function getPolygonAggregator()
    {
        return $this->polygonAggregator;
    }

    /**
     * Sets the polygon aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolygonAggregator $polygonAggregator The polygon aggregator.
     */
    public function setPolygonAggregator(PolygonAggregator $polygonAggregator)
    {
        $this->polygonAggregator = $polygonAggregator;
    }

    /**
     * Gets the polyline aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator The polyline aggregator.
     */
    public function getPolylineAggregator()
    {
        return $this->polylineAggregator;
    }

    /**
     * Sets the polyline aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Overlays\PolylineAggregator $polylineAggregator The polyline aggregator.
     */
    public function setPolylineAggregator(PolylineAggregator $polylineAggregator)
    {
        $this->polylineAggregator = $polylineAggregator;
    }

    /**
     * Aggregates the coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregate(Map $map, array $coordinates = array())
    {
        if (!$map->getOverlays()->isAutoZoom()) {
            $coordinates = $this->aggregateValue($map->getCenter(), $coordinates);
        }

        $coordinates = $this->aggregateBounds($map, $coordinates);
        $coordinates = $this->aggregateCircles($map, $coordinates);
        $coordinates = $this->aggregateInfoWindows($map, $coordinates);
        $coordinates = $this->aggregateMarkers($map, $coordinates);
        $coordinates = $this->aggregatePolygons($map, $coordinates);
        $coordinates = $this->aggregatePolylines($map, $coordinates);

        return $coordinates;
    }

    /**
     * Aggregates the bounds coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateBounds(Map $map, array $coordinates = array())
    {
        foreach ($this->boundAggregator->aggregate($map) as $bound) {
            if ($bound->hasCoordinates()) {
                $coordinates = $this->aggregateValue($bound->getSouthWest(), $coordinates);
                $coordinates = $this->aggregateValue($bound->getNorthEast(), $coordinates);
            }
        }

        return $coordinates;
    }

    /**
     * Aggregates the cirlces coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateCircles(Map $map, array $coordinates = array())
    {
        foreach ($this->circleAggregator->aggregate($map) as $circle) {
            $coordinates = $this->aggregateValue($circle->getCenter(), $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the info windows coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateInfoWindows(Map $map, array $coordinates = array())
    {
        foreach ($this->infoWindowAggregator->aggregate($map) as $infoWindow) {
            if ($infoWindow->hasPosition()) {
                $coordinates = $this->aggregateValue($infoWindow->getPosition(), $coordinates);
            }
        }

        return $coordinates;
    }

    /**
     * Aggregates the markers coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateMarkers(Map $map, array $coordinates = array())
    {
        foreach ($this->markerAggregator->aggregate($map) as $marker) {
            $coordinates = $this->aggregateValue($marker->getPosition(), $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the polygons coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregatePolygons(Map $map, array $coordinates = array())
    {
        foreach ($this->polygonAggregator->aggregate($map) as $polygon) {
            foreach ($polygon->getCoordinates() as $coordinate) {
                $coordinates = $this->aggregateValue($coordinate, $coordinates);
            }
        }

        return $coordinates;
    }

    /**
     * Aggregates the polylines coordinates.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregatePolylines(Map $map, array $coordinates = array())
    {
        foreach ($this->polylineAggregator->aggregate($map) as $polyline) {
            foreach ($polyline->getCoordinates() as $coordinate) {
                $coordinates = $this->aggregateValue($coordinate, $coordinates);
            }
        }

        return $coordinates;
    }
}
