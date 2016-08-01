# Ground Overlay

Polygons are useful overlays to represent arbitrarily-sized areas, but they cannot display images. If you have an image
that you wish to place on a map, you can use a GroundOverlay object.

## Build

First of all, if you want to render a ground overlay, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\GroundOverlay;

$groundOverlay = new GroundOverlay(
    'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
    new Bound(new Coordinate(40.712216, -74.22655), new Coordinate(40.773941, -74.12544))
);
```

The ground overlay constructor requires an url as first argument and a bound as second argument which represents the 
image area. It also accepts additional parameters such as options (default empty):

``` php
use Ivory\GoogleMap\Overlay\GroundOverlay;

$groundOverlay = new GroundOverlay(
    'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
    new Bound(new Coordinate(40.712216, -74.22655), new Coordinate(40.773941, -74.12544)),
    ['clickable' => false]
);
```

## Configure variable

A variable is automatically generated when creating a ground overlay but if you want to update it, you can use:

``` php
$groundOverlay->setVariable('ground_overlay');
```

## Configure url

If you want to update the ground overlay url, you can use:

``` php
$groundOverlay->setUrl('url');
```

## Configure bound

If you want to update the ground overlay bound, you can use:

``` php
$groundOverlay->setBound(-1, -1, 1, 1, true, true);
```

## Configure options

The ground overlay options allows you to configure additional circle aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#GroundOverlayOptions). 
Then, to configure them, you can use:

``` php
$groundOverlay->setOption('clickable', false);
```

## Append to a map

After building your ground overlay, you need to add it to a map with:

``` php
$map->getOverlayManager()->addGroundOverlay($groundOverlay);
```
