# Elevation Response

When you have requested your elevation, the returned object is an `ElevationResponse`. It wraps a status and results.

## Status

The available status are defined by the `ElevationStatus` constants.

``` php
$status = $response->getStatus();
```

## Results

The results is an array of elevations.

``` php
$results = $response->getResults();
```

## Result

Each elevation result contains a location, an elevation and a resolution.

``` php
foreach ($response->getResults() as $result) {
    // ...
}
```

### Location

The location is represented by the `Coordinate`. It is the position for which elevation data is being computed. 
Note that for path requests, the set of location elements will contain the sampled coordinate along the path.

``` php
$location = $result->getLocation();
```

### Elevation

It indicates the elevation of the location in meters.

``` php
$elevation = $result->getElevation();
```

### Resolution

It indicates the maximum distance between data points from which the elevation was interpolated, in meters. This 
property will be missing if the resolution is not known. Note that elevation data becomes more coarse (larger 
resolution values) when multiple points are passed. To obtain the most accurate elevation value for a point, it should 
be queried independently.

``` php
$resolution = $result->getResolution();
```
