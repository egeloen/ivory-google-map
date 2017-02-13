# Geocoder Place Id Request

A geocoder place id request allows you to geocode an address from an place id.

## Build

First of all, let's build a geocoder place id request:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;

$request = new GeocoderPlaceIdRequest('place_id');
```

The geocoder place id request constructor requires an place id as first argument.

## Configure place id

If you want to update the place id, you can use:

``` php
$request->setPlaceId('place_id');
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
