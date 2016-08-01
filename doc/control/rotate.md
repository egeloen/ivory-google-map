# Rotate control

The Rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. This
control appears by default in the top left corner of the map.

## Build

First of all, if you want to render a rotate control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\RotateControl;

$rotateControl = new RotateControl();
```

The rotate control constructor does not require anything but it accepts parameters such as position (default top left):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\RotateControl;

$rotateControl = new RotateControl(ControlPosition::TOP_LEFT);
```

## Configure position

If you want to update the rotate control position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$rotateControl->setPosition(ControlPosition::TOP_RIGHT);
```

## Append to a map

After building your rotate control, you need to add it to a map with:

``` php
$map->getControlManager()->setRotateControl($rotateControl);
```
