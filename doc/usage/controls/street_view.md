# Street view control

The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control
appears by default in the top left corner of the map.

## Build your street view control

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\StreetViewControl;

$streetViewControl = new StreetViewControl();

// Configure your street view control
$streetViewControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the street view control position

For configurating the street view control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\StreetViewControl;

$streetViewControl = new StreetViewControl();

// Sets your control position
$streetViewControl->setControlPosition(ControlPosition::TOP_LEFT);
$streetViewControl->setControlPosition('top_left');

$streetViewControl->setControlPosition(ControlPosition::TOP_CENTER);
$streetViewControl->setControlPosition('top_center');

$streetViewControl->setControlPosition(ControlPosition::TOP_RIGHT);
$streetViewControl->setControlPosition('top_right');

$streetViewControl->setControlPosition(ControlPosition::LEFT_TOP);
$streetViewControl->setControlPosition('left_top');

$streetViewControl->setControlPosition(ControlPosition::LEFT_CENTER);
$streetViewControl->setControlPosition('left_center');

$streetViewControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$streetViewControl->setControlPosition('left_bottom');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_TOP);
$streetViewControl->setControlPosition('right_top');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$streetViewControl->setControlPosition('right_center');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$streetViewControl->setControlPosition('right_bottom');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$streetViewControl->setControlPosition('bottom_left');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$streetViewControl->setControlPosition('bottom_center');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$streetViewControl->setControlPosition('bottom_right');
```

## Add your street view control to the map

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\StreetViewControl;

$streetViewControl = new StreetViewControl();

// Add your street view control to the map
$map->setStreetViewControl($streetViewControl);
$map->setStreetViewControl(ControlPosition::TOP_LEFT);
```
