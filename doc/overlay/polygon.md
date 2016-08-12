# Polygon

Polygon objects are similar to polyline objects in that they consist of a series of coordinates in an ordered sequence.
However, instead of being open-ended, polygons are designed to define regions within a closed loop.

## Build

First of all, if you want to render a polygon, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\Polygon;

$polygon = new Polygon();
```

The polygon constructor does not require anything but It  accepts additional parameters such as coordinates (default 
empty) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Polygon;

$polygon = new Polygon(
    [
        new Coordinate(25.774, -80.190),
        new Coordinate(18.466, -66.118),
        new Coordinate(32.321, -64.757),
        new Coordinate(25.774, -80.190),
    ],
    ['fillOpacity' => 0.5]
);
```

## Configure variable

A variable is automatically generated when creating a polygon but if you want to update it, you can use:

``` php
$polygon->setVariable('polygon');
```

## Configure coordinates

If you want to update the polygon coordinates, you can use:

``` php
$polygon->setCoordinates([]);
```

## Configure options

The polygon options allows you to configure additional polygon aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#PolygonOptions). Then, 
to configure them, you can use:

``` php
$polygon->setOption('fillOpacity', 0.5);
```

## Append to a map

After building your polygon, you need to add it to a map with:

``` php
$map->getOverlayManager()->addPolygon($polygon);
```
