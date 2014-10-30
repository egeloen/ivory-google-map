# Marker

Markers identify locations on the map. By default, they use a standard icon.

## Build your marker

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Marker;

$marker = new Marker(new Coordinate(1.1, 2.2));
```

## Configure your marker

### Configure the variable

``` php
$marker->setVariable('marker');
```

### Configure the position

``` php
use Ivory\GoogleMap\Base\Coordinate;

$marker->setPosition(new Coordinate(1, 2));
```

### Configure the animation

``` php
use Ivory\GoogleMap\Overlays\Animation;

$marker->setAnimation(Animation::BOUNCE);
$marker->setAnimation(Animation::DROP);
```

### Configure the options

``` php
$marker->setOption('clickable', false);
```

## Configure the icon

``` php
use Ivory\GoogleMap\Overlays\Icon;

$marker->setIcon(new Icon('url'));
```

The complete icon configuration is available [here](/doc/overlays/icon.md).

### Configure the shadow

``` php
use Ivory\GoogleMap\Overlays\Icon;

$marker->setShadow(new Icon('url'));
```

The complete shadow configuration is available [here](/doc/overlays/icon.md).

### Configure the shape

``` php
use Ivory\GoogleMap\Overlays\MarkerShape;
use Ivory\GoogleMap\Overlays\MarkerShapeType;

$marker->setShadow(new MarkerShape(MarkerShapeType::CIRCLE, array(1, 2, 3));
```

The complete marker shape configuration is available [here](/doc/overlays/marker_shape.md).

### Configure the info window

``` php
use Ivory\GoogleMap\Overlays\InfoWindow;

$marker->setInfoWindow(new InfoWindow('content'));
```

The complete info window configuration is available [here](/doc/overlays/info_window.md).

## Add your marker on the map

``` php
$map->getOverlays()->addMarker($marker);
```
