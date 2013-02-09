# Ground overlay

Polygons are useful overlays to represent arbitrarily-sized areas, but they cannot display images. If you have an image
that you wish to place on a map, you can use a GroundOverlay object.

## Build your ground overlay

``` php
use Ivory\GoogleMap\Overlays\GroundOverlay;

$groundOverlay = new GroundOverlay();

// Configure your ground overlay options
$groundOverlay->setPrefixJavascriptVariable('ground_overlay_');
$groundOverlay->setUrl('url');
$groundOverlay->setBound(-1, -1, 1, 1, true, true);

$groundOverlay->setOption('clickable', false);
$groundOverlay->setOptions(array('clickable' => false));
```

## Add your ground overlay to the map

``` php
use Ivory\GoogleMap\Overlays\GroundOverlay;

$groundOverlay = new GroundOverlay();

// Add your ground overlay to the map
$map->addGroundOverlay($groundOverlay);
```
