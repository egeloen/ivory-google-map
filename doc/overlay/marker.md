# Marker

Markers identify locations on the map. By default, they use a standard icon.

## Build

First of all, if you want to render a marker, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Marker;

$marker = new Marker(new Coordinate());
```

The marker constructor requires a coordinate as first argument which represents the marker position. It also accepts 
additional parameters such as the animation (default null), icon (default null), shape (default null) and 
options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;

$marker = new Marker(
    new Coordinate(),
    Animation::BOUNCE,
    new Icon(),
    new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]),
    ['clickable' => false]
);
```

## Configure variable

A variable is automatically generated when creating a marker but if you want to update it, you can use:

``` php
$marker->setVariable('marker');
```

## Configure position

If you want to update the marker position, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$marker->setPosition(new Coordinate(1, 1));
```

## Configure animation

If you want to add animation on marker, you can use:

``` php
$marker->setAnimation(Animation::DROP);
```

## Configure icon

If you want to update the marker icon, you can use:

``` php
use Ivory\GoogleMap\Overlay\Icon;

$marker->setIcon(new Icon());
```

If you want to learn more about icon, you can read its [documentation](/doc/overlay/icon.md).

## Configure shape

If you want to update the marker shape, you can use:

``` php
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;

$marker->setIcon(new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]));
```

## Configure options

The marker options allows you to configure additional marker aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#MarkerOptions). 
Then, to configure them, you can use:

``` php
$marker->setOption('flat', true);
```

If you want to learn more about marker shape, you can read its [documentation](/doc/overlay/marker_shape.md).

## Append to a map

``` php
$map->getOverlayManager()->addMarker($marker);
```
