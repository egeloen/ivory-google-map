# Map type control

The map type control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by
default in the top right corner of the map.

## Build

First of all, if you want to render a map type control, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Control\MapTypeControl;

$mapTypeControl = new MapTypeControl();
```

The map type control constructor does not require anything but it accepts parameters such as ids (default roadmap, 
satellite), position (default top right) and style (default default):

``` php
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Control\MapTypeControlStyle;
use Ivory\GoogleMap\MapTypeId;

$mapTypeControl = new MapTypeControl(
    [MapTypeId::ROADMAP, MapTypeId::SATELLITE],
    ControlPosition::TOP_RIGHT,
    MapTypeControlStyle::DEFAULT_
);
```

## Configure ids

If you want to update ids, you can use:

``` php
use Ivory\GoogleMap\MapTypeId;

$mapTypeControl->setIds([MapTypeId::ROADMAP, MapTypeId::SATELLITE]);
```

## Configure position

If you want to update position, you can use:

``` php
use Ivory\GoogleMap\Control\ControlPosition;

$mapTypeControl->setPosition(ControlPosition::TOP_RIGHT);
```

## Configure style

If you want to update the style, you can use:

``` php
use Ivory\GoogleMap\Control\MapTypeControlStyle;

$mapTypeControl->setStyle(MapTypeControlStyle::DEFAULT_);
```


## Append to a map

After building your map type control, you need to add it to a map with:

``` php
$map->getControlManager()->setMapTypeControl($mapTypeControl);
```
