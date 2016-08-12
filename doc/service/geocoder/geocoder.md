# Geocoder API

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into geographic
coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or position the map.
Additionally, the service allows you to perform the converse operation (turning coordinates into addresses). This
process is known as "reverse geocoding".

## Dependencies

The Geocoder API uses [Geocoder](http://github.com/willdurand/Geocoder) which is the most popular PHP Geocoder. So, 
first, I recommend you to read its documentation. To install it, read this [documentation](/doc/installation.md).

It also requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. To install it, read this [documentation](/doc/installation.md).

## Why an other Geocoder?

The Geocoder shipped with the library is not an other Geocoder but an extension of the most popular 
[Geocoder](http://github.com/willdurand/Geocoder). The main difference is instead of giving you a typical response, 
it returns a custom once wrapping Ivory objects allowing you to more easily reuse them. 

## Build

First of all, if you want to geocode a position, you will need to build a geocoder provider. So let's go:

``` php
use Ivory\GoogleMap\Service\Geocoder\GeocoderProvider;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$geocoder = new GeocoderProvider(new Client(), new GuzzleMessageFactory());
```

The geocoder provider constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. 
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle 
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you geocoder provider, you can geocode a position:

``` php
$response = $geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
```

The geocoder provider allows you to geocoder a much more advance request. If you want to learn more about it, you can 
read its [documentation](/doc/service/geocoder/geocoder_request.md).

## Response

When you have geocode your position, the provider give you a response object. If you want to learn more about it, you 
can read its [documentation](/doc/service/geocoder/geocoder_response.md).
