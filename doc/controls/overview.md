# Overview map control

The overview map control displays a thumbnail overview map reflecting the current map viewport within a wider area.
This control appears by default in the bottom right corner of the map, and is by default shown in its collapsed state.

## Build your overview map control

``` php
use Ivory\GoogleMap\Controls\OverviewMapControl;

$overviewMapControl = new OverviewMapControl();
```

## Configure your overview map control

### Configure the initial open state

```
$overviewMapControl->setOpened(true);
```

## Set your overview map control on the map

``` php
$map->getControls()->setOverviewMapControl($overviewMapControl);
```
