# Elevation Request

When you want to build an elevation request, you can do it in one of two ways:

 - A set of one or more locations.
 - A series of connected points along a path.

## Positional request

An elevation positional request allows you to get elevation(s) about one or multiple coordinates:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PositionalElevationRequest;

$response = $elevation->process(new PositionalElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]));
```

If you want to learn more about it, you can read its [documentation](/doc/service/elevation/elevation_positional_request.md).

## Path request

An elevation path request allows you to get elevations along a path:

``` php
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PathElevationRequest;

$response = $elevation->process(new PathElevationRequest([
    new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
    new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]));
```

If you want to learn more about it, you can read its [documentation](/doc/service/elevation/elevation_path_request.md).
