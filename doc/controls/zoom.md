# Zoom control

The Zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level
of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom
left corner on touch devices.

## Build your zoom control

``` php
use Ivory\GoogleMap\Controls\ZoomControl;

$zoomControl = new ZoomControl();
```

## Configure your zoom control

### Configure your zoom control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
$zoomControl->setControlPosition(ControlPosition::TOP_CENTER);
$zoomControl->setControlPosition(ControlPosition::TOP_RIGHT);
$zoomControl->setControlPosition(ControlPosition::LEFT_TOP);
$zoomControl->setControlPosition(ControlPosition::LEFT_CENTER);
$zoomControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$zoomControl->setControlPosition(ControlPosition::RIGHT_TOP);
$zoomControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$zoomControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$zoomControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$zoomControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$zoomControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

### Configure your zoom control style

``` php
use Ivory\GoogleMap\Controls\ZoomControlStyle;

$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
$zoomControl->setZoomControlStyle(ZoomControlStyle::LARGE);
$zoomControl->setZoomControlStyle(ZoomControlStyle::SMALL);
```

## Set your zoom control on the map

``` php
$map->getControls()->setZoomControl($zoomControl);
```
