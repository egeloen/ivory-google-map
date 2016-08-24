# Geocoder Request

Depending on what you want to geocode, you need to choose the appropriate request. The library allows you to geocode
from an address, a coordinate or a place id.

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
