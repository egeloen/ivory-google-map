# Rectangle

A Rectangle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
rectangle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Rectangle; instead, a rectangle has one additional property which defines its
shape : the bound.

## Build

First of all, if you want to render a circle, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Base\Base;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Rectangle;

$rectangle = new Rectangle(new Bound(
    new Coordinate(-1, -1), 
    new Coordinate(1, 1)
));
```

The rectangle constructor requires a bound as first argument which represents its area. It also accepts additional 
parameters such as options (default empty):

``` php
use Ivory\GoogleMap\Base\Base;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Rectangle;

$rectangle = new Rectangle(
    new Bound(
        new Coordinate(-1, -1), 
        new Coordinate(1, 1)
    ),
    ['clickable' => false]
);
```

## Configure variable

A variable is automatically generated when creating a rectangle but if you want to update it, you can use:

``` php
$rectangle->setVriable('rectangle');
```

## Configure bound

If you want to update the bound, you can use:

``` php
use Ivory\GoogleMap\Base\Base;
use Ivory\GoogleMap\Base\Coordinate;

$rectangle->setBound(new Bound(
    new Coordinate(-1, -1), 
    new Coordinate(1, 1)
));
```

## Configure options

The rectangle options allows you to configure additional rectangle aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#RectangleOptions). Then, 
to configure them, you can use:

``` php
$rectangle->setOption('clickable', false);
```

## Append to a map

After building your rectangle, you need to add it to a map with:

``` php
$map->getOverlayManager()->addRectangle($rectangle);
```
