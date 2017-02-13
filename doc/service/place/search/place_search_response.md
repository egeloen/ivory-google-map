# Place Search Response

When you have requested your place search, the returned object is a `PlaceSearchIterator`.

## Iterator

The iterator allows you to navigate over the pagination of the result lazily, meaning each request is performed at each 
iteration of the iterator.

``` php
foreach ($iterator as $response) {
    // ...
}
```

## Response

When you iterator over the iterator, the result is a `PlaceSearchResponse`. It wraps a status, results, html 
attributions and the next page token.
 
### Status

The available status are defined by the `PlaceSearchStatus` constants.

``` php
$status = $response->getStatus();
```

### Results

Each response wraps results according to your request.

``` php
$results = $response->getResults();
```

### Result

Each result is a place giving your detailed informations about it.
 
``` php
foreach ($response->getResults() as $result) {
    // ...
}
```

If you want to learn more about a result, you can read this [documentation](/doc/service/place/base/place.md).

### Html attributions

The html attributions is an array of attributions to display to end users.

``` php
$htmlAttributions = $response->getHtmlAttributions();
```

### Next page token

The next page token is used internally by the iterator in order to iterator over the pagination. 

``` php
$nextPageToken = $response->getNextPageToken();
```
