# Scale control

The Scale control displays a map scale element. This control is not enabled by default.

## Build your scale control

``` php
use Ivory\GoogleMap\Controls\ScaleControl;

$scaleControl = new ScaleControl();
```

## Configure your scale control

### Configure your scale control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$scaleControl->setControlPosition(ControlPosition::TOP_LEFT);
$scaleControl->setControlPosition(ControlPosition::TOP_CENTER);
$scaleControl->setControlPosition(ControlPosition::TOP_RIGHT);
$scaleControl->setControlPosition(ControlPosition::LEFT_TOP);
$scaleControl->setControlPosition(ControlPosition::LEFT_CENTER);
$scaleControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$scaleControl->setControlPosition(ControlPosition::RIGHT_TOP);
$scaleControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$scaleControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$scaleControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$scaleControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$scaleControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

### Configure your scale control style

``` php
use Ivory\GoogleMap\Controls\ScaleControlStyle;

$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
```

## Set your scale control on the map

``` php
$map->getControls()->setScaleControl($scaleControl);
```
