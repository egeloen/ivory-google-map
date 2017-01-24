# Place Photo Request

A place photo request is the starting point when you want to process a photo.

## Build

First of all, if you want to process a photo, you will need to build a place photo request. So let's go:

``` php
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;

$request = new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5P');
```

The place photo request constructor requires the reference as first argument.

## Configure reference

If you want to update the photo reference, you can use:

``` php
$request->setReference('CnRtAAAATLZNl354RwP_9UKbQ_5P');
```

## Configure max width

The max width is the desired one, in pixels, of the image returned by the service.

``` php
$request->setMaxWidth(200)
```

## Configure max height

The max height is the desired one, in pixels, of the image returned by the service.

``` php
$request->setMaxHeight(200)
```
