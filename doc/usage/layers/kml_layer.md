# KML Layer

The Google Maps API supports the KML and GeoRSS data formats for displaying geographic information. For more
information, see official [documentation](http://code.google.com/apis/maps/documentation/javascript/layers.html#KMLLayers).

## Build your KML layer

``` php
use Ivory\GoogleMap\Layers\KMLLayer;

$kmlLayer = new KMLLayer();

// Configure your KML layer options
$kmlLayer->setUrl('http://www.domain.com/kml_layer.kml');

$kmlLayer->setOption('clickable', true);
$kmlLayer->setOption('suppressInfoWindows', false);
$kmlLayer->setOptions(array(
    'clickable'           => true,
    'suppressInfoWindows' => false,
));
```

## Add your KML layer to the map

``` php
use Ivory\GoogleMap\Layers\KMLLayer;

$kmlLayer = new KMLLayer();

// Add your KML layer to the map
$map->addKMLLayer($kmlLayer);
```
