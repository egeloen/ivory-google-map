# Geo Json Layer

[GeoJSON](http://geojson.org/) is a common standard for sharing geospatial data on the internet. It is lightweight and 
easily human-readable, making it ideal for sharing and collaborating.

## Build

First of all, if you want to render a geo json layer, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Layer\GeoJsonLayer;

$geoJsonLayer = new GeoJsonLayer('https://storage.googleapis.com/mapsdevsite/json/google.json');
```

The geo json layer constructor requires an url as first argument. It also accepts additional parameters such as options 
(default empty):

``` php
use Ivory\GoogleMap\Layer\GeoJsonLayer;

$geoJsonLayer = new GeoJsonLayer(
    'https://storage.googleapis.com/mapsdevsite/json/google.json',
    ['idPropertyName' => 'id']
);
```

## Configure url

If you want to update the geo json layer url, you can use:

``` php
$geoJsonLayer->setUrl('https://storage.googleapis.com/mapsdevsite/json/google.json');
```

## Configure options

The geo json layer options allows you to configure additional geo json layer aspects. See the list of available options 
in the official [documentation](https://developers.google.com/maps/documentation/javascript/reference#Data.GeoJsonOptions). 
Then, to configure them, you can use:

``` php
$geoJsonLayer->setOption('idPropertyName', 'id');
```

## Append to a map

After building your geo json layer, you need to add it to a map with:

``` php
$map->getLayerManager()->addGeoJsonLayer($geoJsonLayer);
```
