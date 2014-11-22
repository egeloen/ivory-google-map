# Encoded Polyline

The Encoded Polyline class defines a [Polyline](/doc/overlays/polyline.md) which has been encoded using the algorithm
described [here](http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html).

## Build your encoded polyline

``` php
use Ivory\GoogleMap\Overlays\EncodedPolyline;

$encodedPolyline = new EncodedPolyline('value');
```

## Configure your encoded polyline

### Configure the variable

``` php
$encodedPolyline->setVariable('encoded_polyline');
```

### Configure the value

``` php
$encodedPolyline->setValue('value');
```

### Configure the options

``` php
$polyline->setOption('geodesic', true);
```

## Add your encoded polyline on the map

``` php
$map->getOverlays()->addEncodedPolyline($encodedPolyline);
```
