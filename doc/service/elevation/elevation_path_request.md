# Elevation Path Request

An elevation path request allows uou to get elevations along a path.

## Build

First of all, let's build an elevation path request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PathElevationRequest;

$request = new PathElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]);
```

The elevation path request constructor requires an array of `LocationInterface` as first argument.It also accepts 
additional parameters such as samples (default 3) and options (default empty):

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PathElevationRequest;

$request = new PathElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
], 3);
```

## Configure paths

If you want to update the paths, you can use:

``` php
$request->setPaths([
   new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
   new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]);
```

## Configure samples

It specifies the number of sample points along a path for which to return elevation data (default 3). The samples 
parameter divides the given path into an ordered set of equidistant points along the path:

``` php
$request->setSamples(3);
```
