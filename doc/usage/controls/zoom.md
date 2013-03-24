# Zoom control

The Zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level
of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom
left corner on touch devices.

## Build your zoom control

``` php
use Ivory\GoogleMap\Controls\ControlPosition
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Controls\ZoomControlStyle;

$zoomControl = new ZoomControl();

// Configure your zoom control
$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
```

## Configure your zoom control position

For configurating the zoom control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControl;

$zoomControl = new ZoomControl();

// Sets your control position
$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
$zoomControl->setControlPosition('top_left');

$zoomControl->setControlPosition(ControlPosition::TOP_CENTER);
$zoomControl->setControlPosition('top_center');

$zoomControl->setControlPosition(ControlPosition::TOP_RIGHT);
$zoomControl->setControlPosition('top_right');

$zoomControl->setControlPosition(ControlPosition::LEFT_TOP);
$zoomControl->setControlPosition('left_top');

$zoomControl->setControlPosition(ControlPosition::LEFT_CENTER);
$zoomControl->setControlPosition('left_center');

$zoomControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$zoomControl->setControlPosition('left_bottom');

$zoomControl->setControlPosition(ControlPosition::RIGHT_TOP);
$zoomControl->setControlPosition('right_top');

$zoomControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$zoomControl->setControlPosition('right_center');

$zoomControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$zoomControl->setControlPosition('right_bottom');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$zoomControl->setControlPosition('bottom_left');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$zoomControl->setControlPosition('bottom_center');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$zoomControl->setControlPosition('bottom_right');
```

## Configure your zoom control style

For configurating the zoom control style, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ZoomControlStyle`` is here. It allows you to access all constants which describe zoom
control style. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Controls\ZoomControlStyle;

$zoomControl = new ZoomControl();

// Sets your zoom control style
$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
$zoomControl->setZoomControlStyle('default');

$zoomControl->setZoomControlStyle(ZoomControlStyle::LARGE);
$zoomControl->setZoomControlStyle('large');

$zoomControl->setZoomControlStyle(ZoomControlStyle::SMALL);
$zoomControl->setZoomControlStyle('small');
```

## Add your zoom control to the map

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Controls\ZoomControlStyle;

$zoomControl = new ZoomControl();

// Add your zoom control to the map
$map->setZoomControl($zoomControl);
$map->setZoomControl(ControlPosition::TOP_LEFT, ZoomControlStyle::DEFAULT_);
```
