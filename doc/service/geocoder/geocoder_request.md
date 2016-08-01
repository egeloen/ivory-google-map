# Geocoder Request

A geocoder request is the starting point when you want to geocode a position.

## Build

First of all, if you want to geocode a position, you will need to build a geocoder request. So let's go:

``` php
use Ivory\GoogleMap\Service\Geocoder\GeocoderRequest;

$request = new GeocoderRequest('1600 Amphitheatre Parkway, Mountain View, CA');
```

The geocoder request constructor requires an address as first argument.

## Configure address

If you want to update the address, you can use:

``` php
$request->setAddress('1600 Amphitheatre Parkway, Mountain View, CA');
```

The address also accepts a coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate:

$request->setAddress(new Coordinate(1.1, 2.1));
```

## Configure bound

If you want to restrict the geocoder area, you can use a bound:

``` php
$request->setBound(new Bound(
    new Coordinate(-1.1, -2.1), 
    new Coordinate(2.1, 1.1)
));
```

## Configure region

If you want to update the region, you can use:

``` php
$request->setRegion('en');
```

## Configure language

If you want to update the language, you can use:

``` php
$request->setLanguage('fr');
```
