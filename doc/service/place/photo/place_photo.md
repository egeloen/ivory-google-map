# Place Photo API

The Place Photo service, part of the Google Places API Web Service, is a read-only API that allows you to add high 
quality photographic content to your application. The Place Photo service gives you access to the millions of photos 
stored in the Places and Google+ Local database. When you get place information using a Place Details request, 
photo references will be returned for relevant photographic content. The Nearby Search and Text Search requests also 
return a single photo reference per place, when relevant. Using the Photo service you can then access the referenced 
photos and resize the image to the optimal size for your application.

## Dependencies

The Place Photo API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is 
an http client abstraction library. To install it, read this [documentation](/doc/installation.md).

## Build

First of all, if you want to process a photo, you will need to build a place photo service. So let's go:

``` php
use Ivory\GoogleMap\Service\Direction\Place\Photo\PlacePhotoService;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;

$service = new PlacePhotoService(new Client(), new GuzzleMessageFactory());
```

The Place Photo constructor requires an `HttpClient` as first argument and a `MessageFactory` as second argument. 
Here, I have chosen to use the [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) client as well as the Guzzle 
message factory. Httplug supports the most popular http clients, so, you can choose you preferred one instead.

All services works the same way, so, if you want to learn more about it, you can read this common 
[documentation](/doc/service/service.md) about services.

## Request

Once you have built you place photo service, you can process a request:

``` php
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;

$response = $detail->process(new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5P'));
```

The place photo service allows you to process a much more advance request. If you want to learn more about it, you 
can read its [documentation](/doc/service/place/photo/place_photo_request.md).

## Response

When you have requested the service, it gives you a response object. If you want to learn more about it, you can read 
its [documentation](/doc/service/place/photo/place_photo_response.md).

