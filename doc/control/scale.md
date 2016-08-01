# Scale control

The Scale control displays a map scale element. This control is not enabled by default.

## Build

First of all, if you want to render a scale control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\ScaleControl;

$scaleControl = new ScaleControl();
```

The scale control constructor does not require anything but it accepts parameters such as position (default bottom 
left) and style (default default):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Control\ScaleControlStyle;

$scaleControl = new ScaleControl(
    ControlPosition::BOTTOM_LEFT,
    ScaleControlStyle::DEFAULT_
);
```

## Configure position

If you want to update the scale control position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$scaleControl->setPosition(ControlPosition::BOTTOM_RIGHT);
```

## Configure style

If you want to update the scale control style, you can use:

``` php
use Ivory\GoogleMap\Control\ScaleControlStyle;

$scaleControl->setStyle(ScaleControlStyle::DEFAULT_);
```

## Append to a map

After building your scale control, you need to add it to a map with:

``` php
$map->getControlManager()->setScaleControl($scaleControl);
```
