# Map

The Map is the central point of the library. It allows you to manipulate all available options. If you render the
default map, the library will generate a map of 300px by 300px, centered on the coordinate (0, 0), configured with a
zoom of 3 and using the default controls.

## Build your map

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

## Configure the map

### Configure the variable

``` php
$map->setVariable('map');
```

### Configure the html container id

``` php
$map->setHtmlContainerId('map');
```

### Configure the center

``` php
use Ivory\GoogleMap\Base\Coordinate;

$map->setCenter(new Coordinate(1, 2));
```

### Configure the bound

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

$map->setBound(new Bound(new Coordinate(-2.1, -3.9), new Coordinate(2.6, 1.4)));
```

### Configure map center and zoom

For configurating the map center & zoom, you have three possibilities:

 1. Standard center coordinate and zoom
 2. Fitting a bound
 3. Fitting a bound which extends overlays

#### Standard center coordinate and zoom

To use the standard center coordinate & zoom, you need to disable the auto zoom flag & configure the center/zoom.

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;

$map = new Map();

// Disable the auto zoom flag (default: disabled)
$map->getOverlays()->setAutoZoom(false);

// Sets the center (default: (0, 0)).
$map->setCenter(new Coordinate(1, 2));

// Sets the zoom (default: 3)
$map->setMapOption('zoom', 5);
```

#### Fitting a bound

For fitting a bound, you need to enable the auto zoom flag & configure bound south west & nort east coordinates.
If you extend overlays with the bound, the map will fit the overlays coordinate instead of bound coordinates.

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Map;

$map = new Map();

// Enable the auto zoom flag (default: disabled)
$map->getOverlays()->setAutoZoom(true);

// Sets the bound
$map->setBound(new Bound(new Coordinate(-2.1, -3.9), new Coordinate(2.6, 1.4));
```

#### Fitting a bound which extends overlays

For fitting a bound which extends overlays, you need to enable the auto zoom flag & add overlays to the bound.
In the [overlays documentation](/doc/overlays/index.md), you learn how you can add overlays on the map. If the auto
zoom flag is enabled and you add some overlays on the map, the map bound will automatically extends your overlay. So,
at the end, all your overlays will be visible on your screen.

``` php
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;

$map = new Map();

// Enable the auto zoom flag (default: false)
$map->getOverlays()->setAutoZoom(true);

// Add marker to your map
$map->getOverlays()->addMarker(new Marker());
```

### Configure the map option

``` php
use Ivory\GoogleMap\MapTypeId;

$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
$map->setMapOption('zoom', 4);
```

### Configure the stylesheet option

``` php
$map->setStylesheetOption('width', '300px');
```

### Configure the language

``` php
$map->setLanguage('en');
```

### Configure the libraries

``` php
$map->setLibraries(array('places', 'geometry'));
```

### Configure overlays

The overlays documentation is available [here](/doc/overlays/index.md).

### Configure controls

The controls documentation is available [here](/doc/controls/index.md).

### Configure layers

The layers documentation is available [here](/doc/layers/index.md).

### Configure events

The events documentation is available [here](/doc/events/index.md).
