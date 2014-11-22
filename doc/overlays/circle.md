# Circle

A Circle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
circle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Circle. Instead, a circle has two additional properties which define its shape:
center of the circle, radius of the circle, in meters.

## Build your circle

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Circle;

$circle = new Circle(new Coordinate(1, 2), 3);
```

## Configure your circle

### Configure the variable

``` php
$circle->setVariable('circle');
```

### Configure the center

``` php
use Ivory\GoogleMap\Base\Coordinate;

$circle->setCenter(new Coordinate(1, 2);
```

### Configure the radius

``` php
$circle->setRadius(1);
```

### Configure the options

``` php
$circle->setOption('clickable', false);
```

## Add your circle on the map

``` php
$map->getOverlays()->addCircle($circle);
```
