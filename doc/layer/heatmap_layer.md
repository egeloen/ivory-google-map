# Heatmap Layer

A layer that provides a client-side rendered heatmap, depicting the intensity of data at geographical points.

## Build

First of all, if you want to render a heatmap layer, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Layer\HeatmapLayer;

$heatmapLayer = new HeatmapLayer();
```

The heatmap layer constructor does not require anything but it accepts parameters such as coordinates (default empty) 
and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Layer\HeatmapLayer;

$heatmapLayer = new HeatmapLayer(
    [
        new Coordinate(37.782551, -122.445368),
        new Coordinate(37.782745, -122.444586),
        new Coordinate(37.782842, -122.443688),
        new Coordinate(37.782919, -122.442815),
        new Coordinate(37.782992, -122.442112),
        new Coordinate(37.783100, -122.441461),
        new Coordinate(37.783206, -122.440829),
        new Coordinate(37.783273, -122.440324),
        new Coordinate(37.783316, -122.440023),
        new Coordinate(37.783357, -122.439794),
        new Coordinate(37.783371, -122.439687),
        new Coordinate(37.783368, -122.439666),
        new Coordinate(37.783383, -122.439594),
        new Coordinate(37.783508, -122.439525),
        new Coordinate(37.783842, -122.439591),
        // ...
    ],
    ['dissipating' => true]
);
```

## Configure variable

A variable is automatically generated when creating a heatmap layer but if you want to update it, you can use:

``` php
$heatmapLayer->setVariable('heatmap_layer');
```

## Configure coordinates

If you want to update the heatmap layer coordinates, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$heatmapLayer->setCoordinates([
    new Coordinate(37.782551, -122.445368),
    new Coordinate(37.782745, -122.444586),
    new Coordinate(37.782842, -122.443688),
    new Coordinate(37.782919, -122.442815),
    // ...
]);
```

## Configure options

The heatmap layer options allows you to configure additional heatmap layer aspects. See the list of available options 
in the official [documentation](https://developers.google.com/maps/documentation/javascript/reference#HeatmapLayerOptions). 
Then, to configure them, you can use:

``` php
$heatmapLayer->setOption('dissipating', true);
```

## Append to a map

After building your heatmap layer, you need to add it to a map with:

``` php
$map->getLayerManager()->addHeatmapLayer($heatmapLayer);
```
