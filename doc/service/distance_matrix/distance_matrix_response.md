# Distance Matrix Response

When you have requested your distance matrix, the returned object is an `DistanceMatrixResponse`. It wraps a status, 
origins, destinations and rows.

## Status

The available status are defined by the `DistanceMatrixStatus` constants.

``` php
$status = $response->getStatus();
```

## Origins

It contains an array of addresses as returned by the API from your original request. These are formatted by the
geocoder and localized according to the language parameter passed with the request.

``` php
$origins = $response->getOrigins();
```

## Destinations

It contains an array of addresses as returned by the API from your original request. As with distance matrix origins,
these are localized if appropriate.

``` php
$destinations = $response->getDestinations();
```

## Rows

When the Distance Matrix API returns results, it places them within a rows array. Even if no results are returned
(such as when the origins and/or destinations don't exist), it still returns an empty array. Rows are ordered according
to the values in the origin parameter of the request. Each row corresponds to an origin, and each element within that
row corresponds to a pairing of the origin with a destination value.

Each row array contains one or more distance matrix element entries, which in turn contain the information about a
single origin-destination pairing.

``` php
foreach ($response->getRows() as $row) {
    // ...
}
```

## Element

The information about each origin-destination pairing is represented by the `DistanceMatrixElement`. An element 
contains a status, a duration and a distance.

``` php
foreach ($row->getElements() as $element) {
    // ...
}
```

### Status

The available status are defined by the `DistanceMatrixElementStatus` constants.

``` php
$status = $element->getStatus();
```

### Distance

The duration of this route represented by `Distance`.

``` php
$distance = $element->getDistance();
```

If you want to learn more about the duration, you can read its [documentation](/doc/service/base/distance.md).

#### Duration

The duration of this route represented by `Duration`.

``` php
$duration = $element->getDuration();
```

If you want to learn more about the duration, you can read its [documentation](/doc/service/base/duration.md).
