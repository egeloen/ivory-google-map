# Distance Matrix API

The Google Distance Matrix API is a service that provides travel distance and time for a matrix of origins and
destinations. The information returned is based on the recommended route between start and end points, as calculated
by the Google Maps API, and consists of rows containing duration and distance values for each pair.

This service does not return detailed route information. Route information can be obtained by passing the desired
single origin and destination to the
[Directions API](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/directions/directions.md).

## Request the distance matrix service

``` php
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;

$distanceMatrix = new DistanceMatrix();
```

## Processes a request

``` php
$response = $distanceMatrix->process(array('Vancouver BC'), array('San Francisco'));
```

The distance matrix allows you to proceess a much more advanced request. If you want to lear more, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/distance_matrix/distance_matrix_request.md).

## Distance matrix response

When you have requested your distance matrix, the returned object is an
``Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse``. It wraps a status, origins, destinations and rows.

### Distance matrix status

The available status are defined by the ``Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus`` constants.

``` php
// Get the status
$status = $response->getStatus();
```

### Distance matrix origins

It contains an array of addresses as returned by the API from your original request. These are formatted by the
geocoder and localized according to the language parameter passed with the request.

``` php
// Get the origins
$origins = $response->getOrigins();
```

### Directions matrix destinations

It contains an array of addresses as returned by the API from your original request. As with distance matrix origins,
these are localized if appropriate.

``` php
// Get the destinations
$destinations = $response->getDestinations();
```

### Directions rows

When the Distance Matrix API returns results, it places them within a rows array. Even if no results are returned
(such as when the origins and/or destinations don't exist), it still returns an empty array. Rows are ordered according
to the values in the origin parameter of the request. Each row corresponds to an origin, and each element within that
row corresponds to a pairing of the origin with a destination value.

Each row array contains one or more distance matrix element entries, which in turn contain the information about a
single origin-destination pairing.

``` php
// Get the rows
foreach ($rows as $row) {
    $elements = $row->getElements();
}
```

## Distance matrix element

The information about each origin-destination pairing is represented by the
`Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElement`. An element contains a status, a duration and
a distance.

``` php
foreach ($elements as $element) {
    // Play with distance matrix element.
}
```

### Distance matrix element status

The available status are defined by the ``Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus``
constants.

``` php
// Get the status
$status = $element->getStatus();
```

### Distance matrix element distance

The duration of this route represented by `Ivory\GoogleMap\Services\Base\Distance`.

``` php
// Get the distance
$distance = $element->getDistance();
```

### Distance matrix element duration

The duration of this route represented by `Ivory\GoogleMap\Services\Base\Duration`.

``` php
// Get the duration
$duration = $element->getDuration();
```
