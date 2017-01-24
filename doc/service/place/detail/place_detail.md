# Place Detail API

The Place Detail service allows you to get detailed response for a place. Once you have a place_id or a reference from 
a Place Search, you can request more details about a particular establishment or point of interest by initiating a 
Place Details request. A Place Details request returns more comprehensive information about the indicated place such as 
its complete address, phone number, user rating and reviews.

## Dependencies

The Place Detail API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is 
an http client abstraction library. It also requires the [Ivory Serializer](https://github.com/egeloen/ivory-serializer) 
in order to deserialize the http response. To install them, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to process a place detail, you will need to build a place detail service. So let's go:

``` php
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$detail = new PlaceDetailService(new Client(), new GuzzleMessageFactory());
```

The Place Detail constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. 
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle 
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

The Place Detail constructor also accepts a `SerializerInterface` as third argument. It is highly recommended to 
use it in order to configure a PSR-6 cache pool and so avoid parsing the built-in metadata every time.  

``` php
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Serializer\SerializerBuilder;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$detail = new PlaceDetailService(
    new Client(),
    new GuzzleMessageFactory(),
    SerializerBuilder::create($psr6Pool)
);
```

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you place detail service, you can process a request:

``` php
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;

$response = $detail->process(new PlaceDetailRequest('ChIJN1t_tDeuEmsRUsoyG83frY4'));
```

The place detail service allows you to process a much more advance request. If you want to learn more about it, you 
can read its [documentation](/doc/service/place/detail/place_detail_request.md).

## Response

When you have requested the service, it gives you a response object. If you want to learn more about it, you can read 
its [documentation](/doc/service/place/detail/place_detail_response.md).

