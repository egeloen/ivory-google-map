# Polyline

The Polyline class defines a linear overlay of connected line segments on the map. A Polyline object consists of an
array of coordinates, and creates a series of line segments that connect those locations in an ordered sequence.

## Build your polyline

``` php
use Ivory\GoogleMap\Overlays\Polyline;

$polyline = new Polyline();

// Configure your polyline options
$polyline->setPrefixJavascriptVariable('polyline_');

$polyline->setOption('geodesic', true);
$polyline->setOption('strokeColor', '#ffffff');
$polyline->setOptions(array(
    'geodesic'    => true,
    'strokeColor' => '#ffffff',
));
```

## Add coordinate to your polyline

Like describe in the introduction, a polyline object consists of an array of coordinates. So, you need to add
coordinate to your polyline.

``` php
use Ivory\GoogleMap\Overlays\Polyline;

$polyline = new Polyline();

// Add coordinates to your polyline
$polyline->addCoordinate(0, 0, true);
$polyline->addCoordinate(1, 1, true);
```

## Add your polyline to the map

``` php
use Ivory\GoogleMap\Overlays\Polyline;

$polyline = new Polyline();

// Add your polyline to the map
$map->addPolyline($polyline);
```
