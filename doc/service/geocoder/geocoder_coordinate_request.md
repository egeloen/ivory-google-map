# Geocoder Coordinate Request

A geocoder coordinate request allows you to geocode an address from an coordinate.

## Build

First of all, let's build a geocoder coordinate request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderCoordinateRequest;

$request = new GeocoderCoordinateRequest(new Coordinate(48.865475, 2.321118));
```

The geocoder coordinate request constructor requires an coordinate as first argument.

## Configure coordinate

If you want to update the coordinate, you can use:

``` php
$request->setCoordinate(new Coordinate(48.865475, 2.321118));
```

## Result types

It specifies a type will restrict the results to this type. If multiple types are specified, the API will return all 
addresses that match any of the types.

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressType;

$request->setLocationTypes([GeocoderAddressType::COUNTRY]);
```

## Location types

It specifies a type will restrict the results to this type. If multiple types are specified, the API will return all 
addresses that match any of the types.

``` php
use Ivory\GoogleMap\Service\Base\GeometryLocationType;

$request->setLocationTypes([GeometryLocationType::APPROXIMATE]);
```

## Configure language

If you want to update the language, you can use:

``` php
$request->setLanguage('fr');
```
