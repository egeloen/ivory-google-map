# Info window

Info window displays content in a floating window above the map. The info window looks a little like a comic-book word
balloon. It has a content area and a tapered stem, where the tip of the stem is at a specified location on the map.

## Build

First of all, if you want to render an info window, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\InfoWindow;

$infoWindow = new InfoWindow('content');
```

The info window constructor requires a content as first argument. It also accepts additional parameters such as the type 
(default default), position (default null):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\InfoWindow;
use Ivory\GoogleMap\Overlay\InfoWindowType;

$infoWindow = new InfoWindow('content', InfoWindowType::INFO_BOX, new Coordinate());
```

## Configure variable

A variable is automatically generated when creating an info window but if you want to update it, you can use:

``` php
$infoWindow->setVariable('info_window');
```

## Configure content

If you want to update the info window content, you cant use:

``` php
$infoWindow->setContent('<p>Default content</p>');
```

## Configure position

If you want to update the info window position, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$infoWindow->setPosition(new Coordinate(0, 0));
```

## Configure pixel offset

if you want to update the pixel offset (default null), you can use:
 
``` php
use Ivory\GoogleMap\Base\Size;

$infoWindow->setPixelOffset(new Size(1.1, 2.1));
```

## Configure default open state

By default, the info window is not visible on a map because its default open state is false. That does not mean the 
info window is not created, it just means it is not visible when the map is initially displayed. If you want to display 
it, you can use:

``` php
$infoWindow->setOpen(true);
```

## Configure auto open

The auto open flag is useful when linking an info window to a marker. Basically, if you link an info window to a 
marker, then, when triggering an event on the marker (default click), the linked info window will be automatically 
opened. 

To enable this feature (disabled by default), you can use:
 
``` php
$infoWindow->setAutoOpen(true);
```

## Configure auto open event

The auto open event represents the event triggering the automatic info window opening. If you want to update it, you 
can use:
 
``` php
$infoWindow->setOpenEvent(MouseEvent::DBLCLICK);
```

## Configure auto close

The auto close flag is the opposite of the auto open flag. Basically, if an auto open event is triggered, then, the 
info windows configured with the auto close flag are all closed.

To enable this feature (disabled by default), you can use:

``` php
$infoWindow->setAutoClose(true);
```

## Configure options

The info window options allows you to configure additional circle aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#InfoWindowOptions). 
Then, to configure them, you can use:

``` php
$infoWindow->setOption('zIndex', 10);
```

## Append to a map/marker

After building your info window, you can add it to a map (the info window is draw at the info window coordinate):

``` php
$map->getOverlayManager()->addInfoWindow($infoWindow);
```

Or you can attach it to a marker (the info window is draw on top of the marker):

``` php
$marker->setInfoWindow($infoWindow);
```
