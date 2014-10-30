# KML Layer

The Google Maps API supports the KML and GeoRSS data formats for displaying geographic information. For more
information, see official [documentation](http://code.google.com/apis/maps/documentation/javascript/layers.html#KmlLayers).

## Build your kml layer

``` php
use Ivory\GoogleMap\Layers\KmlLayer;

$kmlLayer = new KmlLayer('url');
```

## Configure your kml layer

### Configure the variable

``` php
$kmlLayer->setVariable('kml_layer');
```

### Configure the url

``` php
$kmlLayer->setUrl('url');
```

### Configure the options

``` php
$kmlLayer->setOption('clickable', true);
```

## Add your kml layer on the map

``` php
$map->getLayers()->addKmlLayer($kmlLayer);
```
