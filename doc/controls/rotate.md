# Rotate control

The Rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. This
control appears by default in the top left corner of the map.

## Build your rotate control

``` php
use Ivory\GoogleMap\Controls\RotateControl;

$rotateControl = new RotateControl();
```

## Configure the rotate control

### Configure the rotate control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$rotateControl->setControlPosition(ControlPosition::TOP_LEFT);
$rotateControl->setControlPosition(ControlPosition::TOP_CENTER);
$rotateControl->setControlPosition(ControlPosition::TOP_RIGHT);
$rotateControl->setControlPosition(ControlPosition::LEFT_TOP);
$rotateControl->setControlPosition(ControlPosition::LEFT_CENTER);
$rotateControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$rotateControl->setControlPosition(ControlPosition::RIGHT_TOP);
$rotateControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$rotateControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$rotateControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$rotateControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$rotateControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

## Set your rotate control on the map

``` php
$map->getControls()->setRotateControl($rotateControl);
```
