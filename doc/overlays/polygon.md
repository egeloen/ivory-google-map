# Polygon

Polygon objects are similar to polyline objects in that they consist of a series of coordinates in an ordered sequence.
However, instead of being open-ended, polygons are designed to define regions within a closed loop.

## Build your polygon

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Polygon;

$polygon = new Polygon(array(
    new Coordinate(1, 2),
    new Coordinate(2, -1),
    new Coordinate(0, 0)
));
```

## Configure your polygon

### Configure the variable

``` php
$polygon->setVariable('polygon');
```

### Configure the coordinate

``` php
use Ivory\GoogleMap\Base\Coordinate;

$polygon->addCoordinate(new Coordinate(1, 2));
```

### Configure the options

``` php
$polygon->setOption('fillColor', '#000000');
```

## Add your polygon on the map

``` php
$map->getOverlays()->addPolygon($polygon);
```
