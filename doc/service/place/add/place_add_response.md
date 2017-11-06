# Place Add Response

When you have requested to add a place, the returned object is a `PlaceAddResponse`. It wraps a place add status, the
Google Maps placeId and the scope.

## Status

The available status are defined by the `PlaceAddStatus` constants.

``` php
$status = $response->getStatus();
```

## PlaceId

The Google Maps placeId of the new place.

``` php
$placeId = $response->getPlaceId();
```

## Scope

The scope of the new place added. Always be APP because the place not yet passed the moderation process

``` php
$scope = $response->getScope();
```

If you want to learn more about the place, you can read its [documentation](/doc/service/place/base/place.md).
