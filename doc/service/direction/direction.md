# Direction API

The Google Direction API is a service that calculates direction between locations using an HTTP request. You can
search for direction for several modes of transportation, include transit, driving, walking or cycling. Direction
may specify origins, destinations and waypoints either as text strings (e.g. "Chicago, IL" or "Darwin, NT, Australia")
or as latitude/longitude coordinates. The Direction API can return multi-part direction using a series of waypoints.

## Dependencies

The Direction API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer) in 
order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to route a direction, you will need to build a direction service. So let's go:

``` php
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$direction = new DirectionService(new Client(), new GuzzleMessageFactory());
```

The direction constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. Here, 
I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle message 
factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The direction constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to use it 
in order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.

``` php
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$direction = new DirectionService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you direction service, you can request a direction:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;

$response = $direction->route(new DirectionRequest(
    new AddressLocation('New York'), 
    new AddressLocation('Washington')
));
```

The direction service allows you to route a much more advance request. If you want to learn more about it, you can 
read its [documentation](/doc/service/direction/direction_request.md).

## Response

When you have requested your direction, the service give you a response object. If you want to learn more about it, you 
can read its [documentation](/doc/service/direction/direction_response.md).
