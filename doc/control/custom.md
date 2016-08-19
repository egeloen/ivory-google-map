# Custom Control

As well as modifying the style and position of existing API controls, you can create your own controls to handle 
interaction with the user. Controls are stationary widgets which float on top of a map at absolute positions, as 
opposed to overlays, which move with the underlying map. More fundamentally, a control is simply a `<div>` element 
which has an absolute position on the map, displays some UI to the user, and handles interaction with either the user 
or the map, usually through an event handler.

## Build

First of all, if you want to render a custom control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;

$control = <<<EOF
var control = document.createElement('div');
control.style.backgroundColor = '#fff';
control.style.border = '2px solid #fff';
control.style.marginBottom = '22px';
control.style.textAlign = 'center';
control.innerHTML = 'Control';

return control;
EOF;

$customControl = new CustomControl(ControlPosition::TOP_CENTER, $control);
```

The custom control constructor requires a position as first argument and the control definition as second argument. 

## Configure position

If you want to update the custom control position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$customControl->setPosition(ControlPosition::TOP_RIGHT);
```

## Configure control

The control definition are pure javascript where you must return the created `div` element. If you want to update it, 
you can use:

``` php
$control = <<<EOF
var control = document.createElement('div');
control.style.backgroundColor = '#fff';
control.style.border = '2px solid #fff';
control.style.marginBottom = '22px';
control.style.textAlign = 'center';
control.innerHTML = 'Control';

return control;
EOF;

$customControl->setControl($control);
```

## Append to a map

After building your custom control, you need to add it to a map with:

``` php
$map->getControlManager()->addCustomControl($customControl);
```
