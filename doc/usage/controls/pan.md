# Pan control

The Pan control displays buttons for panning the map. This control appears by default in the top left corner of the
map on non-touch devices. The Pan control also allows you to rotate 45° imagery, if available.

## Build your pan control

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\PanControl;

$panControl = new PanControl();

// Configure your pan control
$panControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the pan control position

For configurating the pan control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\PanControl;

$panControl = new PanControl();

// Sets your control position
$panControl->setControlPosition(ControlPosition::TOP_LEFT);
$panControl->setControlPosition('top_left');

$panControl->setControlPosition(ControlPosition::TOP_CENTER);
$panControl->setControlPosition('top_center');

$panControl->setControlPosition(ControlPosition::TOP_RIGHT);
$panControl->setControlPosition('top_right');

$panControl->setControlPosition(ControlPosition::LEFT_TOP);
$panControl->setControlPosition('left_top');

$panControl->setControlPosition(ControlPosition::LEFT_CENTER);
$panControl->setControlPosition('left_center');

$panControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$panControl->setControlPosition('left_bottom');

$panControl->setControlPosition(ControlPosition::RIGHT_TOP);
$panControl->setControlPosition('right_top');

$panControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$panControl->setControlPosition('right_center');

$panControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$panControl->setControlPosition('right_bottom');

$panControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$panControl->setControlPosition('bottom_left');

$panControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$panControl->setControlPosition('bottom_center');

$panControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$panControl->setControlPosition('bottom_right');
```

## Add your pan control to the map

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\PanControl;

$panControl = new PanControl();

// Add your pan control to the map
$map->setPanControl($panControl);
$map->setPanControl(ControlPosition::TOP_LEFT);
```
