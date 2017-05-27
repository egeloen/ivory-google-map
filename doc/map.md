# Map

## Build

First of all, if you want to render a map, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

## Configure variable

A variable is automatically generated when creating a map but if you want to update it, you can use:
 
``` php
$map->setVariable('map');
```

## Configure html id

If you want to update the default html id (map_canvas) used for the map div container, you can use:

``` php
$map->setHtmlId('map_canvas');
```

## Configure center & zoom

For configuring the map center & zoom, you have three possibilities:

 1. Standard center coordinate & zoom
 2. Fitting a bound
 3. Fitting a bound which extends overlays/layers

### Standard center coordinate & zoom

To use the standard center coordinate & zoom, you need to disable the auto zoom flag (disabled by default) & configure 
the center/zoom.

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;

$map = new Map();

// Disable the auto zoom flag (disabled by default)
$map->setAutoZoom(false);

// Sets the center
$map->setCenter(new Coordinate(0, 0));

// Sets the zoom
$map->setMapOption('zoom', 3);
```

### Fitting a bound

For fitting a bound, you need to enable the auto zoom flag & configure bound south west & north east coordinates.
If you extend overlays with the bound, the map will fit the overlays coordinate instead of the bound coordinates.

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;

$map = new Map();

// Enable the auto zoom flag (disabled by default)
$map->setAutoZoom(true);

// Sets the bound coordinates
$map->setBound(new Bound(new Coordinate(-2.1, -3.9), new Coordinate(2.6, 1.4)));
```

### Fitting a bound which extends overlays/layers

For fitting a bound which extends overlays/layers, you need to enable the auto zoom flag & add overlays to the bound.
In the [Overlays documentation](/doc/overlay/index.md) as well as in the [Layers documentation](/doc/layer/index.md), 
you learn how you can add overlays/layers to the map. If the auto zoom flag is enabled and you add some overlays/layers 
to the map, the map bound will automatically extend the added elements. So, at the end, all your overlays/layers will 
be automatically visible on your screen.

It is important to understand that the overlays/layers are only extended by the map bound if the auto zoom is enabled
at the moment you add them. That allows you for example to center the map on some markers and add others markers on
the map which will be outside of the map viewport.

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;

$map = new Map();

// This marker will not be extended by the map bound because the auto zoom is not enabled
$map->getOverlayManager()->addMarker(new Marker(new Coordinate(4.4705, 54.6548)));

// Enable the auto zoom flag (disabled by default)
$map->setAutoZoom(true);

// Add markers to your map which will be extended by the map bound
$map->getOverlayManager()->addMarker(new Marker(new Coordinate(1.543, 1.8754)));
$map->getOverlayManager()->addMarker(new Marker(new Coordinate(2.654, 1.8657)));
```

That's it. The map will be automatically centered on your marker.

## Configure libraries

Sometimes, you want to use the map & other Google Map related libraries. The library provides many integrations but not
all of them. If you need a custom library (for example `drawing`), you can use:

```
$map->addLibrary('drawing');
```

## Configure options

The map options allows you to configure additional map aspects. See the list of available options in the Google Map
[documentation](https://developers.google.com/maps/documentation/javascript/reference#MapOptions). Then, to configure
them, you can use:

``` php
use Ivory\GoogleMap\MapTypeId;

$map->setMapOption('mapTypeId', MapTypeId::HYBRID);
```

## Configure static options

The static options allows you to configure specific options which will be used when rendering your map as a static 
image. By default, the library will try to guess as much options as possible according to default options but if you 
want to override them, you can use the following ones:

 - center: The map center which can be either a `Coordinate` or an address (default `Coordinate(0, 0)`).
 - zoom: The map zoom (default 3).
 - format: The map format (default png).
 - scale: The map scale (default 1).
 - width: The map width (default 300).
 - height: The map height (default 300).
 - maptype: The map type (default roadmap).
 - styles: The map styles which override the default map rendering.
 - visible: The elements which should be visible which can be either a `Coordinate`, an address or an array of both 
   (default empty).
   
``` php
use Ivory\GoogleMap\MapTypeId;

$map->setStaticOption('maptype', MapTypeId::HYBRID);
```

The [Map styles](https://developers.google.com/maps/documentation/static-maps/styling) allows you to customize the 
presentation of the standard Google map by applying your own styles. Here, an example showing you how to use it:

``` php
$map->setStaticOption('styles', [
    [
        'feature' => 'road.highway', // Optional
        'element' => 'geometry',     // Optional
        'rules'   => [               // Mandatory (at least one rule)
            'color'      => '0xc280e9',
            'visibility' => 'simplified',
        ],
    ],
    [
        'feature' => 'transit.line',
        'rules'   => [
            'visibility' => 'simplified',
            'color'      => '0xbababa',
        ]
    ],
]);
```

## Configure stylesheets

If you want to configure map stylesheets, you can use:

``` php
$map->setStylesheet('position', 'absolute');
```

## Configure html attributes

If you want to configure map container html attributes, you can use:

``` php
$map->setHtmlAttribute('class', 'my-class');
```
