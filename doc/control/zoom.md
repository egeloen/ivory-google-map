# Zoom control

The Zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level
of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom
left corner on touch devices.

## Build

First of all, if you want to render a zoom control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\ZoomControl;

$zoomControl = new ZoomControl();
```

The zoom control constructor does not require anything but it accepts parameters such as position (default top left) 
and style (default default):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\ZoomControl;
use Ivory\GoogleMap\Control\ZoomControlStyle;

$zoomControl = new ZoomControl(
    ControlPosition::TOP_LEFT,
    ZoomControlStyle::DEFAULT_
);
```

## Configure position

If you want to update th zoom control position, you can use:

``` php
$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure style

If you want to update the zoom control style, you can use:

``` php
$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
```

## Append to a map

After building your zoom control, you need to add it to a map with:

``` php
$map->getControlManager()->setZoomControl($zoomControl);
```
