# Geocoder Request

## Build a geocoder request

``` php
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

$request = new GeocoderRequest();

// Set address
$request->setAddress('1600 Amphitheatre Parkway, Mountain View, CA');

// Or set coordinate (reverse geocoding)
$request->setCoordinate(1.1, 2.1, true);

$request->setBound(-1.1, -2.1, 2.1, 1.1, true, true);
$request->setRegion('en');
$request->setLanguage('en');
$request->setSensor(false);
```

If you set an address & a coordinate, address takes precedence over coordinate.

## Geocoloate your request

``` php
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

$request = new GeocoderRequest();

// Geocode your request
$response = $geocoder->geocode($request);
```
