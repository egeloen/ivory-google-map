# Rotate control

The Rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. This
control appears by default in the top left corner of the map.

## Build your rotate control

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\RotateControl;

$rotateControl = new RotateControl();

// Configure your rotate control
$rotateControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the rotate control position

For configurating the rotate control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\RotateControl;

$rotateControl = new RotateControl():

// Sets your control position
$rotateControl->setControlPosition(ControlPosition::TOP_LEFT);
$rotateControl->setControlPosition('top_left');

$rotateControl->setControlPosition(ControlPosition::TOP_CENTER);
$rotateControl->setControlPosition('top_center');

$rotateControl->setControlPosition(ControlPosition::TOP_RIGHT);
$rotateControl->setControlPosition('top_right');

$rotateControl->setControlPosition(ControlPosition::LEFT_TOP);
$rotateControl->setControlPosition('left_top');

$rotateControl->setControlPosition(ControlPosition::LEFT_CENTER);
$rotateControl->setControlPosition('left_center');

$rotateControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$rotateControl->setControlPosition('left_bottom');

$rotateControl->setControlPosition(ControlPosition::RIGHT_TOP);
$rotateControl->setControlPosition('right_top');

$rotateControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$rotateControl->setControlPosition('right_center');

$rotateControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$rotateControl->setControlPosition('right_bottom');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$rotateControl->setControlPosition('bottom_left');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$rotateControl->setControlPosition('bottom_center');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$rotateControl->setControlPosition('bottom_right');
```

## Add your rotate control to the map

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\RotateControl;

$rotateControl = new RotateControl();

// Add your rotate control to the map
$map->setRotateControl($rotateControl);
$map->setRotateControl(ControlPosition::TOP_LEFT);
```
