# Alternate Place ID

An alternate place id is alternative for a place with a scope.

## Place id

The most likely reason for a place to have an alternative place ID is if your application adds a place and receives an 
application-scoped place ID, then later receives a Google-scoped place ID after passing the moderation process.

``` php
$placeId = $alternatePlaceId->getPlaceId();
```

## Scope

The scope of an alternative place ID will always be `APP`, indicating that the alternative place ID is recognised by 
your application only.

``` php
$scope = $alternatePlaceId->getScope();
```

The scope is represented by the `PlaceScope` constants.
