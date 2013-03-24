# Scale control

The Scale control displays a map scale element. This control is not enabled by default.

## Build your scale control

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

$scaleControl = new ScaleControl();

// Configure your scale control
$scaleControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
```

## Configure your scale control position

For configurating the pan control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ScaleControl;

$scaleControl = new ScaleControl();

// Sets your control position
$scaleControl->setControlPosition(ControlPosition::TOP_LEFT);
$scaleControl->setControlPosition('top_left');

$scaleControl->setControlPosition(ControlPosition::TOP_CENTER);
$scaleControl->setControlPosition('top_center');

$scaleControl->setControlPosition(ControlPosition::TOP_RIGHT);
$scaleControl->setControlPosition('top_right');

$scaleControl->setControlPosition(ControlPosition::LEFT_TOP);
$scaleControl->setControlPosition('left_top');

$scaleControl->setControlPosition(ControlPosition::LEFT_CENTER);
$scaleControl->setControlPosition('left_center');

$scaleControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$scaleControl->setControlPosition('left_bottom');

$scaleControl->setControlPosition(ControlPosition::RIGHT_TOP);
$scaleControl->setControlPosition('right_top');

$scaleControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$scaleControl->setControlPosition('right_center');

$scaleControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$scaleControl->setControlPosition('right_bottom');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$scaleControl->setControlPosition('bottom_left');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$scaleControl->setControlPosition('bottom_center');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$scaleControl->setControlPosition('bottom_right');
```

## Configure your scale control style

For configurating the scale control style, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ScaleControlStyle`` is here. It allows you to access all constants which describe scale
control style. If you don't want to use this class, you can directly use the constant value.

``` php
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

$scaleControl = new ScaleControl();

// Sets your scale control style
$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
```

## Add your scale control to the map

``` php
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

$scaleControl = new ScaleControl();

// Add your scale control to the map
$map->setScaleControl($scaleControl);
$map->setScaleControl(ControlPosition::BOTTOM_LEFT, ScaleControlStyle::DEFAULT_);
```
