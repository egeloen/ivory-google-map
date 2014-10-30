# Usage

Before starting, I recommend you to read the google map API v3 documentation which is available
[here](http://code.google.com/apis/maps/documentation/javascript/reference.html). It will give you a better understand
for the next parts.

## Build your map

The Map is the central point of the library. It allows you to manipulate all available options. If you render the
default map, the library will generate a map of 300px by 300px, centered on the coordinate (0, 0), configured with a
zoom of 3 and using the default controls.

Example:

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

## Configure your map

Now, you have a map, you can configure it easily. The map configuration is available [here](/doc/map.md).

Example:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\Marker;

$map->getOverlays()->addMarker(new Marker(new Coordinate(1.1, 2.2)));
```

## Render your map

Now, you have builded and configured your map, you can render it. The map rendering documentation is available
[here](/doc/helpers/rendering.md).

Example:

``` php
use Ivory\GoogleMap\Helpers\Factories\HelperFactory;

$helperFactory = new HelperFactory();

$mapHelper = $helperFactory->createMapHelper();
$apiHelper = $helperFactory->createApiHelper();

echo $mapHelper->render($map);
echo $apiHelper->render(array($map));
```
