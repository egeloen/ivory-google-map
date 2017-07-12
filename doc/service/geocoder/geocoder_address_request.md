# Geocoder Address Request

A geocoder address request allows you to geocode a coordinate from an address. 

## Build

First of all, let's build a geocoder address request:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;

$request = new GeocoderAddressRequest('1600 Amphitheatre Parkway, Mountain View, CA');
```

The geocoder address request constructor requires an address as first argument.

## Configure address

If you want to update the address, you can use:

``` php
$request->setAddress('1600 Amphitheatre Parkway, Mountain View, CA');
```

Be aware, the address also allows IP address.

## Configure components

If you want to provide component filtering, you can use:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderComponentType;

$request->setComponents([
    GeocoderComponentType::POSTAL_CODE => 59800,
    GeocoderComponentType::COUNTRY   => 'fr',
]);
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
