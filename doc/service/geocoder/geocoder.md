# Geocoder API

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into geographic
coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or position the map.
Additionally, the service allows you to perform the converse operation (turning coordinates into addresses). This
process is known as "reverse geocoding".

## Dependencies

The Geocoder API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer) in 
order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to geocode a position, you will need to build a geocoder provider. So let's go:

``` php
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$geocoder = new GeocoderService(new Client(), new GuzzleMessageFactory());
```

The geocoder constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. Here, 
I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle message 
factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The geocoder constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to use it in 
order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.  

``` php
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$geocoder = new GeocoderService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you geocoder provider, you can geocode a position or an address:

``` php
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;

$request = new GeocoderAddressRequest('1600 Amphitheatre Parkway, Mountain View, CA');
$response = $geocoder->geocode($request);
```

The geocoder provider allows you to geocoder a much more advance request. If you want to learn more about it, you can 
read its [documentation](/doc/service/geocoder/geocoder_request.md).

## Response

When you have geocode your position, the provider give you a response object. If you want to learn more about it, you 
can read its [documentation](/doc/service/geocoder/geocoder_response.md).
