# Geocoding API

The Geocoding API uses [Geocoder](http://github.com/willdurand/Geocoder) which is a PHP 5.3 library for issuing
Geocoding. So, first, I would recommend you to read his documentation.

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into geographic
coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or position the map.
Additionally, the service allows you to perform the converse operation (turning coordinates into addresses). This
process is known as "reverse geocoding".

## Create your geocoder

``` php
use Ivory\GoogleMap\Services\Geocoding\Geocoder;

$geocoder = new Geocoder();
```

## Configure your geocoder

``` php
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Geocoder\HttpAdapter\CurlHttpAdapter;

$geocoder->registerProviders(array(
    new GeocoderProvider(new CurlHttpAdapter()),
));
```

### The standard geocoder

If you use the standard Geocoder components, I recommend you to directly read this own documentation available
[here](http://www.geocoder-php.org).

### The Ivory geocoder

The specific Ivory Google Map Geocoder has been added to allow you to geocode a very advanced request & use the
response to directly build your overlays without having to construct the objects by yourself. If you are interested
about this geocoder, the documentation is available [here](/doc/services/geocoding/ivory_geocoder.md).

## Geocode your request

``` php
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

$request = new GeocoderRequest();

// Geocode your request
$response = $geocoder->geocode($request);
```

If you want to learn more about the geocoder request, you can read this
[documentation](/doc/services/geocoding/geocoder_request.md).
