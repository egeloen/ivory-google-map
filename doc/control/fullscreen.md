# Fullscreen control

The Fullscreen control is the control that opens the map in fullscreen mode. By default, this control is not visible. 
When enabled, it appears near the top right of the map.

## Build

First of all, if you want to render a fullscreen control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\FullscreenControl;

$fullscreenControl = new FullscreenControl();
```

The fullscreen control constructor does not require anything but it accepts parameters such as position (default top left):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\FullscreenControl;

$fullscreenControl = new FullscreenControl(ControlPosition::TOP_LEFT);
```

## Configure position

If you want to update the fullscreen control position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$fullscreenControl->setPosition(ControlPosition::TOP_RIGHT);
```

## Append to a map

After building your fullscreen control, you need to add it to a map with:

``` php
$map->getControlManager()->setFullscreenControl($fullscreenControl);
```
