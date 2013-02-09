# Circle

A Circle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
circle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Circle. Instead, a circle has two additional properties which define its shape:
center of the circle, radius of the circle, in meters.

## Build your circle

``` php
use Ivory\GoogleMap\Overlays\Circle;

$circle = new Circle();

// Configure your circle options
$circle->setPrefixJavascriptVariable('circle_');
$circle->setCenter(0, 0, true);
$circle->setRadius(1);

$circle->setOption('clickable', false);
$circle->setOption('strokeWeight', 2);
$circle->setOptions(array(
    'clickable'    => false,
    'strokeWeight' => 2,
));
```

## Add your circle to the map

``` php
use Ivory\GoogleMap\Overlays\Circle;

$circle = new Circle();

// Add your circle to the map
$map->addCircle($circle);
```
