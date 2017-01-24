# Place Detail Request

A place detail request is the starting point when you want to get detail about a specific place.

## Build

First of all, if you want to process a place detail, you will need to build a place detail request. So let's go:

``` php
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;

$request = new PlaceDetailRequest('ChIJN1t_tDeuEmsRUsoyG83frY4');
```

The place detail request constructor requires an place id as first argument.

## Configure place id

The place id is a textual identifier that uniquely identifies a place. If you want to update it:

``` php
$request->setPlaceId('ChIJN1t_tDeuEmsRUsoyG83frY4');
```

## Configure language

If you want to configure the language:

``` php
$request->setLanguage('fr');
```
