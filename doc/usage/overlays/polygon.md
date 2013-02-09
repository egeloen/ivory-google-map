# Polygon

Polygon objects are similar to polyline objects in that they consist of a series of coordinates in an ordered sequence.
However, instead of being open-ended, polygons are designed to define regions within a closed loop.

## Build your polygon

``` php
use Ivory\GoogleMap\Overlays\Polygon;

$polygon = new Polygon();

// Configure your polygon options
$polygon->setPrefixJavascriptVariable('polygon_');

$polygon->setOption('fillColor', '#000000');
$polygon->setOption('fillOpacity', 0.5);
$polygon->setOptions(array(
    'fillColor'   => '#000000',
    'fillOpacity' => 0.5,
));
```

## Add coordinate to your polygon

Like describe in the introduction, a polygon object consists of an array of coordinates. So, you need to add coordinate
to your polygon.

``` php
use Ivory\GoogleMap\Overlays\Polygon;

$polygon = new Polygon();

// Add coordinates to your polygon
$polygon->addCoordinate(0, 0, true);
$polygon->addCoordinate(1, 1, true);
```

## Add your polygon to the map

``` php
use Ivory\GoogleMap\Overlays\Polygon;

$polygon = new Polygon();

// Add your polygon to the map
$map->addPolygon($polygon);
```
