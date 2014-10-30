# Map type control

The map type control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by
default in the top right corner of the map.

## Build your map type control

``` php
use Ivory\GoogleMap\Controls\MapTypeControl;

$mapTypeControl = new MapTypeControl();
```

## Configure the map type control

### Configure the map type control IDs

``` php
use Ivory\GoogleMap\MapTypeId;

$mapTypeControl->addMapTypeId(MapTypeId::HYBRID);
$mapTypeControl->addMapTypeId(MapTypeId::ROADMAP);
$mapTypeControl->addMapTypeId(MapTypeId::SATELLITE);
$mapTypeControl->addMapTypeId(MapTypeId::TERRAIN);
```

### Configure the map type control position

``` php
use Ivory\GoogleMap\Controls\ControlPosition;

$mapTypeControl->setControlPosition(ControlPosition::TOP_LEFT);
$mapTypeControl->setControlPosition(ControlPosition::TOP_CENTER);
$mapTypeControl->setControlPosition(ControlPosition::TOP_RIGHT);
$mapTypeControl->setControlPosition(ControlPosition::LEFT_TOP);
$mapTypeControl->setControlPosition(ControlPosition::LEFT_CENTER);
$mapTypeControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$mapTypeControl->setControlPosition(ControlPosition::RIGHT_TOP);
$mapTypeControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$mapTypeControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
```

### Configure the map type control style

``` php
use Ivory\GoogleMap\Controls\MapTypeControlStyle;

$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DEFAULT_);
$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);
$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::HORIZONTAL_BAR);
```

## Set your map type control on the map

``` php
$map->getControls()->setMapTypeControl($mapTypeControl);
```
