# Polyline

The Polyline class defines a linear overlay of connected line segments on the map. A Polyline object consists of an
array of coordinates, and creates a series of line segments that connect those locations in an ordered sequence.

## Build your polyline

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Polyline;

$polyline = new Polyline(array(
    new Coordinate(1, 2),
    new Coordinate(2, -1),
    new Coordinate(0, 0)
));
```

## Configure your polyline

### Configure the variable

``` php
$polyline->setVariable('polyline');
```

### Configure the coordinates

``` php
use Ivory\GoogleMap\Base\Coordinate;

$polyline->addCoordinate(new Coordinate(1, 2));
```

### Configure the options

``` php
$polyline->setOption('geodesic', true);
```

## Add your polyline on the map

``` php
$map->getOverlays()->addPolyline($polyline);
```
