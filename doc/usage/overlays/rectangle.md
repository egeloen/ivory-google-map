# Rectangle

A Rectangle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
rectangle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Rectangle; instead, a rectangle has one additional property which defines its
shape : the bound.

## Build your rectangle

``` php
use Ivory\GoogleMap\Overlays\Rectangle;

$rectangle = new Rectangle();

// Configure your rectangle options
$rectangle->setPrefixJavascriptVariable('rectangle_');
$rectangle->setBound(-1, -1, 1, 1, true, true);

$rectangle->setOption('clickable', false);
$rectangle->setOption('strokeColor', '#ffffff');
$rectangle->setOptions(array(
    'clickable'   => false,
    'strokeColor' => '#ffffff',
));
```

## Add your rectangle to the map

``` php
use Ivory\GoogleMap\Overlays\Rectangle;

$rectangle = new Rectangle();

// Add your rectangle to the map
$map->addRectangle($rectangle);
```
