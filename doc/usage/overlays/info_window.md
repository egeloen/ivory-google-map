# Info window

Info window displays content in a floating window above the map. The info window looks a little like a comic-book word
balloon. It has a content area and a tapered stem, where the tip of the stem is at a specified location on the map.

## Build your info window

``` php
use Ivory\GoogleMap\Overlays\InfoWindow;

$infoWindow = new InfoWindow();

// Configure your info window options
$infoWindow->setPrefixJavascriptVariable('info_window_');
$infoWindow->setPosition(0, 0, true);
$infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
$infoWindow->setContent('<p>Default content</p>');
$infoWindow->setOpen(false);
$infoWindow->setAutoOpen(true);
$infoWindow->setOpenEvent(MouseEvent::CLICK);
$infoWindow->setAutoClose(false);
$infoWindow->setOption('disableAutoPan', true);
$infoWindow->setOption('zIndex', 10);
$infoWindow->setOptions(array(
    'disableAutoPan' => true,
    'zIndex'         => 10,
));
```

## Add your info window to the map

``` php
use Ivory\GoogleMap\Overlays\InfoWindow;

$infoWindow = new InfoWindow();

// Add your info window to the map
$map->addInfoWindow($infoWindow);
```

## Add your info window to a marker

``` php
use Ivory\GoogleMap\Overlays\InfoWindow;

$infoWindow = new InfoWindow();

// Add your info window to the marker
$marker->setInfoWindow($infoWindow);
```

## Configure info window open event

For configurating the info window open event, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Events\MouseEvent`` is here. It allows you to access all constants which describe open event. If you
don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\InfoWindow;

$infoWindow = new InfoWindow();

// Sets your open event
$infoWindow->setOpenEvent(MouseEvent::CLICK);
$infoWindow->setOpenEvent('click');

$infoWindow->setOpenEvent(MouseEvent::DBLCLICK);
$infoWindow->setOpenEvent('dblclick');

$infoWindow->setOpenEvent(MouseEvent::MOUSEUP);
$infoWindow->setOpenEvent('mouseup');

$infoWindow->setOpenEvent(MouseEvent::MOUSEDOWN);
$infoWindow->setOpenEvent('mousedown');

$infoWindow->setOpenEvent(MouseEvent::MOUSEOVER);
$infoWindow->setOpenEvent('mouseover');

$infoWindow->setOpenEvent(MouseEvent::MOUSEOUT);
$infoWindow->setOpenEvent('mouseout');
```
