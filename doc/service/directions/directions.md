# Directions API

The Google Directions API is a service that calculates directions between locations using an HTTP request. You can
search for directions for several modes of transportation, include transit, driving, walking or cycling. Directions
may specify origins, destinations and waypoints either as text strings (e.g. "Chicago, IL" or "Darwin, NT, Australia")
or as latitude/longitude coordinates. The Directions API can return multi-part directions using a series of waypoints.

## Dependencies

The Directions API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. To install it, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to route a direction, you will need to build a directions service. So let's go:

``` php
use Ivory\GoogleMap\Service\Directions\Directions;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$directions = new Directions(new Client(), new GuzzleMessageFactory());
```

The directions constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. Here, 
I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle message 
factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you directions service, you can request a direction:

``` php
use Ivory\GoogleMap\Service\Directions\DirectionsRequest;

$response = $directions->route(new DirectionsRequest('New York', 'Washington'));
```

The directions service allows you to route a much more advance request. If you want to learn more about it, you can 
read its [documentation](/doc/service/directions/directions_request.md).

## Response

When you have requested your direction, the service give you a response object. If you want to learn more about it, you 
can read its [documentation](/doc/service/directions/directions_response.md).
