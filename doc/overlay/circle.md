# Circle

A Circle is similar to a Polygon in that you can define custom colors, weights, and opacities for the edge of the
circle (the "stroke") and custom colors and opacities for the area within the enclosed region (the "fill"). Unlike a
Polygon, you do not define paths for a Circle. Instead, a circle has two additional properties which define its shape:
center of the circle, radius of the circle, in meters.

## Build

First of all, if you want to render a circle, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Circle;

$circle = new Circle(new Coordinate());
```

The circle constructor requires a coordinate as first argument which represents the center of the circle. It also 
accepts additional parameters such as radius (default 1.0) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Circle;

$circle = new Circle(new Coordinate(), 10, ['clickable' => false]);
```

## Configure variable

A variable is automatically generated when creating a circle but if you want to update it, you can use:

``` php
$circle->setVariable('circle');
```

## Configure center

If you want to update the center, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$circle->setCenter(new Coordinate(1, 1));
```

## Configure radius

If you want to update the radius, you can use:

``` php
$circle->setRadius(10);
```

## Configure options

The circle options allows you to configure additional circle aspects. See the list of available options in the official
[documentation](https://developers.google.com/maps/documentation/javascript/reference#CircleOptions). Then, to 
configure them, you can use:

``` php
$circle->setOption('clickable', false);
```

## Append to a map

After building your circle, you need to add it to a map with:

``` php
$map->getOverlayManager()->addCircle($circle);
```
