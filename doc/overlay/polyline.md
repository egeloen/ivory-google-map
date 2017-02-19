# Polyline

Polyline objects are similar to polyline objects in that they consist of a series of coordinates in an ordered sequence.
However, instead of being open-ended, polylines are designed to define regions within a closed loop.

## Build

First of all, if you want to render a polyline, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\Polyline;

$polyline = new Polyline();
```

The polyline constructor does not require anything but it accepts additional parameters such as coordinates (default
empty), icon sequences (default empty) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Polyline;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$polyline = new Polyline(
    [
        new Coordinate(25.774, -80.190),
        new Coordinate(18.466, -66.118),
        new Coordinate(32.321, -64.757),
        new Coordinate(25.774, -80.190),
    ],
    [
        new IconSequence(new Symbol(SymbolPath::FORWARD_OPEN_ARROW)),
    ]
    ['fillOpacity' => 0.5]
);
```

## Configure variable

A variable is automatically generated when creating a polyline but if you want to update it, you can use:

``` php
$polyline->setVariable('polyline');
```

## Configure coordinates

If you want to update the polyline coordinates, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$polyline->setCoordinates([
    new Coordinate(25.774, -80.190),
    new Coordinate(18.466, -66.118),
    new Coordinate(32.321, -64.757),
    new Coordinate(25.774, -80.190),
]);
```

## Configure icon sequences

If you want to update the icon sequences, you can use:

``` php
use Ivory\GoogleMap\Overlay\IconSequence;
use Ivory\GoogleMap\Overlay\Symbol;
use Ivory\GoogleMap\Overlay\SymbolPath;

$polyline->setIconSequences([
    new IconSequence(new Symbol(SymbolPath::FORWARD_OPEN_ARROW)),
]);
```

If you want to learn more about icon sequence, you can read its [documentation](/doc/overlay/icon_sequence.md).

## Configure options

The polyline options allows you to configure additional polyline aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#PolylineOptions). Then, 
to configure them, you can use:

``` php
$polyline->setOption('fillOpacity', 0.5);
```

## Configure static options

The static options allows you to configure specific options which will be used when rendering your polyline in a static 
map. By default, the library will try to guess as much options as possible according to default options but if you 
want to override them, you can use the following ones:

 - locations: The polyline locations which can be either an array of `Coordinate` or an array of address.
 - styles: The polyline styles (default empty).
 
The styles is an array which can wrap the following options:

 - geodesic: The polyline path should be interpreted as a geodesic (default false).
 - color: The polyline color.
 - fillcolor: The polyline fill color.
 - weight: The polyline weight.

``` php
use Ivory\GoogleMap\Base\Coordinate;

$polyline->setStaticOption('locations', [
    new Coordinate(1, 1), 
    'Lille, France',
]);
```

## Append to a map

After building your polyline, you need to add it to a map with:

``` php
$map->getOverlayManager()->addPolyline($polyline);
```
