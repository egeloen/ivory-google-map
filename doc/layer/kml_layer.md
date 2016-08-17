# KML Layer

The Google Maps API supports the KML and GeoRSS data formats for displaying geographic information. For more
information, read the official [documentation](http://code.google.com/apis/maps/documentation/javascript/layer.html#KMLLayers).

## Build

First of all, if you want to render a kml layer, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Layer\KmlLayer;

$kmlLayer = new KmlLayer('http://www.domain.com/kml_layer.kml');
```

The kml layer constructor requires an url as first argument. It also accepts additional parameters such as options 
(default empty):

``` php
use Ivory\GoogleMap\Layer\KmlLayer;

$kmlLayer = new KmlLayer(
    'http://www.domain.com/kml_layer.kml',
    ['suppressInfoWindows' => true]
);
```

## Configure variable

A variable is automatically generated when creating a kml layer but if you want to update it, you can use:

``` php
$kmlLayer->setVariable('kml_layer');
```

## Configure url

If you want to update the kml layer url, you can use:

``` php
$kmlLayer->setUrl('http://www.domain.com/kml_layer.kml');
```

## Configure options

The kml layer options allows you to configure additional kml layer aspects. See the list of available options in the 
official [documentation](https://developers.google.com/maps/documentation/javascript/reference#KmlLayerOptions). Then, 
to configure them, you can use:

``` php
$kmlLayer->setOption('suppressInfoWindows', true);
```

## Append to a map

After building your kml layer, you need to add it to a map with:

``` php
$map->getLayerManager()->addKmlLayer($kmlLayer);
```
