# Elevation Positional Request

An elevation positional request allows you to get elevation(s) about one or multiple coordinates.

## Build

First of all, let's build an elevation positional request:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PositionalElevationRequest;

$request = new PositionalElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]);
```

The elevation path request constructor requires an array of `LocationInterface` as first argument.

## Configure locations

If you want to update the locations, you can use:

``` php
$request->setLocations([
   new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
   new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]);
```
