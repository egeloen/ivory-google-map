# Distance Matrix API

The Google Distance Matrix API is a service that provides travel distance and time for a matrix of origins and
destinations. The information returned is based on the recommended route between start and end points, as calculated
by the Google Maps API, and consists of rows containing duration and distance values for each pair.

This service does not return detailed route information. Route information can be obtained by passing the desired
single origin and destination to the [Direction API](/doc/service/direction/direction.md).

## Dependencies

The Distance Matrix API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an 
http client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer) 
in order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to process a distance matrix, you will need to build a distance matrix service. So let's go:

``` php
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$distanceMatrix = new DistanceMatrixService(new Client(), new GuzzleMessageFactory());
```

The distance matrix constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. 
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle 
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The distance matrix constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to 
use it in order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.  

``` php
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$distanceMatrix = new DistanceMatrixService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you distance matrix service, you can process a matrix:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequest;

$response = $distanceMatrix->process(new DistanceMatrixRequest(
    [new AddressLocation('Vancouver BC')], 
    [new AddressLocation('San Francisco')]
));
```

The distance matrix allows you to process a much more advanced request. If you want to learn more about it, you can read 
its [documentation](/doc/service/distance_matrix/distance_matrix_request.md).

## Response

When you have requested your distance matrix, the service give you a response object. If you want to learn more about 
it, you can read its [documentation](/doc/service/distance_matrix/distance_matrix_response.md).
