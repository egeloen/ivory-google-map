# Encoded Polyline

The Encoded Polyline class defines a [Polyline](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polyline.md)
which has been encoded using the algorithm described
[here](http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html).

## Build your encoded polyline

``` php
use Ivory\GoogleMap\Overlays\EncodedPolyline;

$encodedPolyline = new EncodedPolyline();

// Configure your encoded polyline options
$polyline->setPrefixJavascriptVariable('polyline_');

$encodedPolyline->setValue('encoded_polyline_value');

$polyline->setOption('geodesic', true);
$polyline->setOption('strokeColor', '#ffffff');
$polyline->setOptions(array(
    'geodesic'    => true,
    'strokeColor' => '#ffffff',
));
```

## Add your encoded polyline to the map

``` php
use Ivory\GoogleMap\Overlays\EncodedPolyline;

$encodedPolyline = new EncodedPolyline();

// Add your encoded polyline to the map
$map->addEncodedPolyline($encodedPolyline);
```
