# Distance Matrix API

The Distance Matrix API uses [egeloen/http-adapter](http://github.com/egeloen/ivory-http-adapter) which is a PHP 5.3
library for issuing http requests.

The Google Distance Matrix API is a service that provides travel distance and time for a matrix of origins and
destinations. The information returned is based on the recommended route between start and end points, as calculated
by the Google Maps API, and consists of rows containing duration and distance values for each pair.

This service does not return detailed route information. Route information can be obtained by passing the desired
single origin and destination to the [Directions API](/doc/services/directions/directions.md).

## Build your distance matrix service

``` php
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix;
use Ivory\HttpAdapter\SocketHttpAdapter;

$distanceMatrix = new DistanceMatrix(new SocketHttpAdapter());
```

If you want to use it with a business account, you can read this [documentation](/doc/services/business_account.md).

## Process a request

``` php
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;

$response = $distanceMatrix->process(new DistanceMatrixRequest(
    array('Vancouver BC'),
    array('San Francisco')
));
```

If you want to learn more about the distance matrix request, you can read this
[documentation](/doc/services/distance_matrix/distance_matrix_request.md).

## Distance matrix response

When you have requested your distance matrix, the returned object is an
`Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse`. It wraps a status, origins, destinations and rows.

### Distance matrix status

The available status are defined by the `Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus` constants.

``` php
$status = $response->getStatus();
```

### Distance matrix origins

It contains an array of addresses as returned by the API from your original request. These are formatted by the
geocoder and localized according to the language parameter passed with the request.

``` php
$origins = $response->getOrigins();
```

### Directions matrix destinations

It contains an array of addresses as returned by the API from your original request. As with distance matrix origins,
these are localized if appropriate.

``` php
$destinations = $response->getDestinations();
```

### Distance matrix rows

When the Distance Matrix API returns results, it places them within a rows array. Even if no results are returned
(such as when the origins and/or destinations don't exist), it still returns an empty array. Rows are ordered according
to the values in the origin parameter of the request. Each row corresponds to an origin, and each element within that
row corresponds to a pairing of the origin with a destination value.

Each row array contains one or more distance matrix element entries, which in turn contain the information about a
single origin-destination pairing.

``` php
$rows = $response->getRows();
```

## Distance matrix row

``` php
foreach ($response->getRows() as $row) {

}
```

### Distance matrix elements

``` php
$elements = $row->getElements();
```

## Distance matrix element

The information about each origin-destination pairing is represented by the
`Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElement`. An element contains a status, a duration and
a distance.

``` php
foreach ($row->getElements() as $element) {

}
```

### Distance matrix element status

The available status are defined by the `Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus`
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
