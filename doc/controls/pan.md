# Pan control

The Pan control displays buttons for panning the map. This control appears by default in the top left corner of the
map on non-touch devices. The Pan control also allows you to rotate 45° imagery, if available.

## Build your pan control

``` php
use Ivory\GoogleMap\Controls\PanControl;

$panControl = new PanControl();
```

## Configure the pan control

### Configure the pan control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$panControl->setControlPosition(ControlPosition::TOP_LEFT);
$panControl->setControlPosition(ControlPosition::TOP_CENTER);
$panControl->setControlPosition(ControlPosition::TOP_RIGHT);
$panControl->setControlPosition(ControlPosition::LEFT_TOP);
$panControl->setControlPosition(ControlPosition::LEFT_CENTER);
$panControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$panControl->setControlPosition(ControlPosition::RIGHT_TOP);
$panControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$panControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$panControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$panControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$panControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

## Set your pan control on the map

``` php
$map->getControls()->setPanControl($panControl);
```
