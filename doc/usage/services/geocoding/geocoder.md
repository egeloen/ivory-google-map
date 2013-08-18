# Geocoding API

The Geocoding API uses [Geocoder](http://github.com/willdurand/Geocoder) which is a PHP 5.3 library for issuing
Geocoding. So, I recommend you to read his documentation.

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into geographic
coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or position the map.
Additionally, the service allows you to perform the converse operation (turning coordinates into addresses). This
process is known as "reverse geocoding".

## Request a geocoder

``` php
use Ivory\GoogleMap\Services\Geocoding\Geocoder;

$geocoder = new Geocoder();
```

The Ivory Google Map Geocoder allows you to build all available geocoder directly by configuration file.

Available providers:

   - ``Geocoder\Provider\BindMapsProvider``
   - ``Geocoder\Provider\FreeGeoIpProvider``
   - ``Geocoder\Provider\GoogleMapsProvider``
   - ``Geocoder\Provider\HostIpProvider``
   - ``Geocoder\Provider\IpInfoDbProvider``
   - ``Geocoder\Provider\YahooProvider``
   - ``Ivory\GoogleMapBundle\Model\Services\Geocoding\Provider``

Available adapters:

   - ``Geocoder\HttpAdapter\BuzzHttpAdapter``
   - ``Geocoder\HttpAdapter\CurlHttpAdapter``
   - ``Geocoder\HttpAdapter\GuzzleHttpAdapter``
   - ``Geocoder\HttpAdapter\ZendHttpAdapter``

To use these providers/adapters, simply register them:

``` php
use Ivory\GoogleMap\Services\Geocoding\Geocoder;
use Ivory\GoogleMap\Services\Geocoding\GeocoderProvider;
use Geocoder\HttpAdapter\CurlHttpAdapter;

$geocoder = new Geocoder();
$geocoder->registerProviders(array(
    new GeocoderProvider(new CurlHttpAdapter()),
));
```

## The standard Geocoder

If you use the standard Geocoder components, I recommand you to directly read this own documentation available
[here](http://www.geocoder-php.org/).

## The Ivory Google Map Geocoder

The specific Ivory Google Map Geocoder has been added to allow you to geocode a very advanced request & use the
response to directly build your overlays. If you are interested about this geocoder, the documentation is available
[here](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/geocoding/ivory_geocoder.md).
