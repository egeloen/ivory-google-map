# Encoded Polyline

The Encoded Polyline class defines a [Polyline](/doc/overlay/polyline.md) which has been encoded using the 
algorithm described [here](http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html).

## Build

First of all, if you want to render an encoded polyline, you will need to build one. So let's go:

``` php
use Ivory\GoogleMap\Overlay\EncodedPolyline;

$encodedPolyline = new EncodedPolyline('_p~iF~ps|U_ulLnnqC_mqNvxq`@');
```

The circle constructor requires a encoded value as first argument. It also accepts additional parameters such as 
options (default empty):

``` php
use Ivory\GoogleMap\Overlay\EncodedPolyline;

$encodedPolyline = new EncodedPolyline('_p~iF~ps|U_ulLnnqC_mqNvxq`@', ['geodesic' => true]);
```

## Configure variable

A variable is automatically generated when creating an encoded polyline but if you want to update it, you can use:

``` php
$encodedPolyline->setVariable('encoded_polyline');
```

## Configure value

If you want to update the encoded polyline value, you can use:

``` php
$encodedPolyline->setValue('encoded_polyline_value');
```

## Configure options

The encoded polyline options allows you to configure additional circle aspects. See the list of available options in 
the official [documentation](https://developers.google.com/maps/documentation/javascript/reference#PolylineOptions). 
Then, to configure them, you can use:

``` php
$polyline->setOption('geodesic', true);
```

## Configure static options

The static options allows you to configure specific options which will be used when rendering your encoded polyline 
in a static map. By default, the library will try to guess as much options as possible according to default options but 
if you want to override them, you can use the following ones:

 - locations: The encoded polyline locations which can be either an array of `Coordinate` or an array of address.
 - styles: The encoded polyline styles (default empty).
 
The styles is an array which can wrap the following options:

 - geodesic: The encoded polyline path should be interpreted as a geodesic (default false).
 - color: The encoded polyline color.
 - fillcolor: The encoded polyline fill color.
 - weight: The encoded polyline weight.

``` php
use Ivory\GoogleMap\Base\Coordinate;

$encodedPolyline->setStaticOption('locations', [
    new Coordinate(1, 1), 
    'Lille, France',
]);
```

## Append to a map

After building your encoded polyline, you need to add it to a map with:

``` php
$map->getOverlayManager()->addEncodedPolyline($encodedPolyline);
```
