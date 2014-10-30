# Street view control

The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control
appears by default in the top left corner of the map.

## Build your street view control

``` php
use Ivory\GoogleMap\Controls\StreetViewControl;

$streetViewControl = new StreetViewControl();
```

## Configure the street view control

### Configure the street view control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$streetViewControl->setControlPosition(ControlPosition::TOP_LEFT);
$streetViewControl->setControlPosition(ControlPosition::TOP_CENTER);
$streetViewControl->setControlPosition(ControlPosition::TOP_RIGHT);
$streetViewControl->setControlPosition(ControlPosition::LEFT_TOP);
$streetViewControl->setControlPosition(ControlPosition::LEFT_CENTER);
$streetViewControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$streetViewControl->setControlPosition(ControlPosition::RIGHT_TOP);
$streetViewControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$streetViewControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$streetViewControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$streetViewControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$streetViewControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

## Set your street view control on the map

``` php
$map->getControls()->setStreetViewControl($streetViewControl);
```
