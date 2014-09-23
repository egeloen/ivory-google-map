# Legend

Add a legend on your map based on markers present on map.

![Image of legend](http://i.imgur.com/L6xu56f.png)

## Add your markers

You must define names on the icons which will make the legend.

```php
$markerImageLow = new MarkerImage();
$markerImageLow->setUrl('/photo/trash_load_low.png');
$markerImageLow->setName('Load <= 30%');

$markerImageMedium = new MarkerImage();
$markerImageMedium->setUrl('/photo/trash_load_medium.png');
$markerImageMedium->setName('30% > Load < 80%');

$markerImageHigh = new MarkerImage();
$markerImageHigh->setUrl('/photo/trash_load_high.png');
$markerImageHigh->setName('80% >= Load');

$marker = new Marker();
$marker->setPosition(45.18445671880465, 5.724220275878906);
$marker->setIcon($markerImageLow);
$map->addMarker($marker);

$marker = new Marker();
$marker->setPosition(45.163158228926385, 5.756492614746094);
$marker->setIcon($markerImageMedium);
$map->addMarker($marker);

$marker = new Marker();
$marker->setPosition(45.16170576909783, 5.695037841796875);
$marker->setIcon($markerImageHigh);
$map->addMarker($marker);
```

## Build your legend

``` php
use Ivory\GoogleMap\Overlays\Legend;

$legend = new Legend();

// Configure your legend options
$legend->setStyles(array(
    'background' => 'white',
    'padding' => '10px',
    'border' => '1px solid #CCCCCC',
    'border-radius' => '5px'
));

```

## Add your legend to the map

Now you have configurated your legend, you need to add it to the map.

``` php
use Ivory\GoogleMap\Overlays\Legend;

$legend = new Legend();

// Add your marker to the map
$map->setLegend($legend);
```
