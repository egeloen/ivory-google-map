# Geocoder Request

If you just want to geocode a simple string or a coordinate you don't need to build a request, you can directly use the 
built-in Geocoder API:

``` php
$response = $geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
// or
$response = $geocoder->reverse(48.865475, 2.321118);
```

This is already nice but it does not provide as much features as Google provide. The geocoder provider also supports 
three specialized request which allows you to geocode a much more advanced location.

## Address request

An address request allows you to geocode a coordinate from an address:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;

$request = new GeocoderAddressRequest('1600 Amphitheatre Parkway, Mountain View, CA');
$response = $geocoder->geocode($request);
```

If you want to learn more about it, you can read its [documentation](/doc/service/geocoder/geocoder_address_request.md).

## Coordinate request

A coordinate request allows you to geocode an address from an coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderCoordinateRequest;

$request = new GeocoderCoordinateRequest(new Coordinate(48.865475, 2.321118));
$response = $geocoder->geocode($request);
```

If you want to learn more about it, you can read its [documentation](/doc/service/geocoder/geocoder_coordinate_request.md).

## Place id request

A geocoder place id request allows you to geocode an address from an place id:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;

$request = new GeocoderPlaceIdRequest('place_id');
$response = $geocoder->geocode($request);
```

If you want to learn more about it, you can read its [documentation](/doc/service/geocoder/geocoder_place_id_request.md).
