# Street view control

The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control
appears by default in the top left corner of the map.

## Build

First of all, if you want to render a street view control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\StreetViewControl;

$streetViewControl = new StreetViewControl();
```

The street view control constructor does not require anything but it accepts parameters such as position (default top 
left):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\StreetViewControl;

$streetViewControl = new StreetViewControl(ControlPosition::TOP_LEFT);
```

## Configure position

If you want to update the street view control position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$streetViewControl->setPosition(ControlPosition::TOP_RIGHT);
```

## Append to a map

``` php
$map->getControlManager()->setStreetViewControl($streetViewControl);
```
