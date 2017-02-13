# Elevation API

The Google Maps Elevation API provides a simple interface to query locations on the earth for elevation data. 
Additionally, you may request sampled elevation data along paths, allowing you to calculate elevation changes along 
routes.

## Dependencies

The Elevation API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer) in 
order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to process an elevation, you will need to build an elevation service. So let's go:

``` php
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$elevation = new ElevationService(new Client(), new GuzzleMessageFactory());
```

The elevation constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. 
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle 
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The elevation constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to use it in 
order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.  

``` php
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$elevation = new ElevationService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you elevation service, you can process an elevation:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PositionalElevationRequest;

$response = $elevation->process(new PositionalElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]));
```

The elevation allows you to process a much more advanced request. If you want to lear more about it, you can read 
its [documentation](/doc/service/elevation/elevation_request.md).

## Response

When you have requested your elevation, the service give you a response object. If you want to learn more about 
it, you can read its [documentation](/doc/service/elevation/elevation_response.md).

