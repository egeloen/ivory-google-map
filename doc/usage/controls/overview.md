# Overview map control

The overview map control displays a thumbnail overview map reflecting the current map viewport within a wider area.
This control appears by default in the bottom right corner of the map, and is by default shown in its collapsed state.

## Build your overview map control

``` php
use Ivory\GoogleMap\Controls\OverviewMapControl;

$overviewMapControl = new OverviewMapControl();

// Configure your overview map control
$overviewMapControl->setOpened(false);
```

## Add your overview map control to the map

``` php
use Ivory\GoogleMap\Controls\OverviewMapControl;

$overviewMapControl = new OverviewMapControl();

// Add your overview map control to the map
$map->setOverviewMapControl($overviewMapControl);
$map->setOverviewMapControl(false);
```
