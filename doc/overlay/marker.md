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
additional parameters such as the animation (default null), icon (default null), symbol (default null), shape (default
null) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$marker = new Marker(
    new Coordinate(),
    Animation::BOUNCE,
    new Icon(),
    new Symbol(SymbolPath::CIRCLE),
    new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]),
    ['clickable' => false]
);
```

If you pass an icon and a symbol together, the icon will be used.

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

If a symbol was previously set, it will be automatically removed in order to use your icon instead. If you want to
learn more about icon, you can read its [documentation](/doc/overlay/icon.md).

## Configure symbol

If you want to update the marker symbol, you can use:

``` php
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$marker->setSymbol(new Symbol(SymbolPath::CIRCLE));
```

If an icon was previously set, it will be automatically removed in order to use your symbol instead. If you want to
learn more about symbol, you can read its [documentation](/doc/overlay/symbol.md).

## Configure shape

If you want to update the marker shape, you can use:

``` php
use Ivory\GoogleMap\Overlay\MarkerShape;
use Ivory\GoogleMap\Overlay\MarkerShapeType;

$marker->setShape(new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]));
```

If you want to learn more about marker shape, you can read its [documentation](/doc/overlay/marker_shape.md).

## Configure options

The marker options allows you to configure additional marker aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#MarkerOptions). 
Then, to configure them, you can use:

``` php
$marker->setOption('flat', true);
```

## Configure static options

The static options allows you to configure specific options which will be used when rendering your marker in a static 
map. By default, the library will try to guess as much options as possible according to default options but if you 
want to override them, you can use the following ones:

 - location: The marker location which can be either a `Coordinate` or an address.
 - styles: The marker styles (default empty).
 
The styles is an array which can wrap the following options:

 - icon: The marker icon url.
 - anchor: The marker icon anchor which can be either a `Point` or a descriptive anchor (default normal).
 - size: The marker size (default normal).
 - color: The marker color (default none).
 - label: The marker label (default none).

``` php
use Ivory\GoogleMap\MapTypeId;

$marker->setStaticOption('location', 'Lille, France');
```

## Append to a map

``` php
$map->getOverlayManager()->addMarker($marker);
```
