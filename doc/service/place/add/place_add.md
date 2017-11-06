# Place Add API

You can complete Google Maps database sending data from your application. Doing this can help you to show to your users
real information about a place and help Google to fix errors or add a new place.

## Dependencies

The Place Add API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is
an http client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer)
in order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to add a place, you will need to build a place add service. So let's go:

``` php
use Ivory\GoogleMap\Service\Place\Add\PlaceAddService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$place = new PlaceAddService(new Client(), new GuzzleMessageFactory());
```

The Place Add constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument.
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The Place Add constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to
use it in order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.

``` php
use Ivory\GoogleMap\Service\Place\Add\PlaceAddService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$add = new PlaceAddService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you place add service, you can process a request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Base\PlaceType;
use Ivory\GoogleMap\Service\Place\Add\Request\PlaceAddRequest;

$response = $place->process(new PlaceAddRequest(
    new Coordinate(-33.8669710, 151.1958750),
    'Google Shoes!',
    PlaceType::SHOE_STORE
);
```

The place add service allows you to send more information. If you want to learn more about it, you
can read its [documentation](/doc/service/place/add/place_add_request.md).

## Response

When you have requested the service, it gives you a response object. If you want to learn more about it, you can read
its [documentation](/doc/service/place/add/place_add_response.md).
