# Info window

Info window displays content in a floating window above the map. The info window looks a little like a comic-book word
balloon. It has a content area and a tapered stem, where the tip of the stem is at a specified location on the map.

## Build your info window

``` php
use Ivory\GoogleMap\Overlays\InfoWindow;

$infoWindow = new InfoWindow('content');
```

## Configure your info window

### Configure the variable

``` php
$infoWindow->setVariable('info_window');
```

### Configure the content

``` php
$infoWindow->setContent('<p>Default content</p>');
```

### Configure the position

``` php
use Ivory\GoogleMap\Base\Coordinate;

$infoWindow->setPosition(new Coordinate(2, 1);
```

Be aware, that the position is not needed if you attach your info window on a marker as it will be placed at the
marker position.

### Configure the pixel offset

``` php
use Ivory\GoogleMap\Base\Size;

$infoWindow->setPixelOffset(new Size(1.1, 2.1, 'px', 'pt'));
```

### Configure the initial open state

``` php
$infoWindow->setOpen(false);
```

### Configure the open event

``` php
use Ivory\GoogleMap\Events\MouseEvent;

$infoWindow->setOpenEvent(MouseEvent::CLICK);
$infoWindow->setOpenEvent(MouseEvent::DBLCLICK);
$infoWindow->setOpenEvent(MouseEvent::MOUSEUP);
$infoWindow->setOpenEvent(MouseEvent::MOUSEDOWN);
$infoWindow->setOpenEvent(MouseEvent::MOUSEOVER);
$infoWindow->setOpenEvent(MouseEvent::MOUSEOUT);
```

### Configure the auto open state

``` php
$infoWindow->setAutoOpen(true);
```

### Configure the auto close state

``` php
$infoWindow->setAutoClose(false);
```

### Configure the type

``` php
use Ivory\GoogleMap\Overlays\InfoWindowType;

$infoWindow->setType(InfoWindowType::DEFAULT_);
$infoWindow->setType(InfoWindowType::INFOBOX);
```

### Configure the options

``` php
$infoWindow->setOption('disableAutoPan', true);
```

## Add your info window on the map

``` php
$map->getOverlays()->addInfoWindow($infoWindow);
```

## Set your info window on a marker

``` php
$marker->setInfoWindow($infoWindow);
```
