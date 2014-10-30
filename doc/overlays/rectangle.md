# Rectangle

A Rectangle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
rectangle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Rectangle; instead, a rectangle has one additional property which defines its
shape: the bound.

## Build your rectangle

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlays\Rectangle;

$rectangle = new Rectangle(new Bound(new Coordinate(-1, -1), new Coordinate(1, 1));
```

## Configure your rectangle

### Configure the variable

``` php
$rectangle->setVariable('rectangle');
```

### Configure the bound

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

$rectangle->setBound(new Bound(new Coordinate(-1, -1), new Coordinate(1, 1));
```

### Configure the options

``` php
$rectangle->setOption('clickable', false);
```

## Add your rectangle on the map

``` php
$map->getOverlays()->addRectangle($rectangle);
```
