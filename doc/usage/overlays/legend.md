# Legend

Add a legend on your map based on markers present on map.

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
