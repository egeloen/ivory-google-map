# Place Photo API

The Place Photo service, part of the Google Places API Web Service, is a read-only API that allows you to add high 
quality photographic content to your application. The Place Photo service gives you access to the millions of photos 
stored in the Places and Google+ Local database. When you get place information using a Place Details request, 
photo references will be returned for relevant photographic content. The Nearby Search and Text Search requests also 
return a single photo reference per place, when relevant. Using the Photo service you can then access the referenced 
photos and resize the image to the optimal size for your application.

## Build

First of all, if you want to process a photo, you will need to build a place photo service. So let's go:

``` php
use Ivory\GoogleMap\Service\Direction\Place\Photo\PlacePhotoService;

$service = new PlacePhotoService();
```

All services works the same way, so, if you want to learn more about it, you can read this common
[documentation](/doc/service/service.md) about services except that the place photo service does not use an http client
and message factory as it does not need to issue http requests.

## Request

Once you have built you place photo service, you can process a request:

``` php
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;

$url = $detail->process(new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5P'));
```

The place photo service allows you to process a much more advance request. If you want to learn more about it, you 
can read its [documentation](/doc/service/place/photo/place_photo_request.md).
