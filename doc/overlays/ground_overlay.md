# Ground overlay

Polygons are useful overlays to represent arbitrarily-sized areas, but they cannot display images. If you have an image
that you wish to place on a map, you can use a GroundOverlay object.

## Build your ground overlay

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\GroundOverlay;

$groundOverlay = new GroundOverlay('url', new Bound(new Coordinate(1.1, 2.2), new Coordinate(3.3, 4.4));
```

## Configure your ground overlay

### Configure the variable

``` php
$groundOverlay->setVariable('ground_overlay');
```

### Configure the url

``` php
$groundOverlay->setUrl('url');
```

### Configure the bound

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

$groundOverlay->setBound(new Bound(new Coordinate(1.1, 2.2), new Coordinate(3.3, 4.4));
```

### Configure the options

``` php
$groundOverlay->setOption('clickable', false);
```

## Add your ground overlay on the map

``` php
$map->getOverlays()->addGroundOverlay($groundOverlay);
```
