# Place Detail Response

When you have requested your place detail, the returned object is a `PlaceDetailResponse`. It wraps a place detail 
status, html attributions and the result.

## Status

The available status are defined by the `PlaceDetailStatus` constants.

``` php
$status = $response->getStatus();
```

## Html Attributions

The html attributions is a set of text which must be displayed to the user.

``` php
$htmlAttributions = $response->getHtmlAttributions();
```

## Result

The result wraps the detailed place information requested.

``` php
$result = $response->getResult();
```

If you want to learn more about the place, you can read its [documentation](/doc/service/place/base/place.md).
