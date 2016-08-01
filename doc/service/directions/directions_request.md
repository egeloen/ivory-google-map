# Directions Request

A directions request is the starting point when you want to request a direction.

## Build

First of all, if you want to route a direction, you will need to build a directions request. So let's go:

``` php
use Ivory\GoogleMap\Service\Directions\DirectionsRequest;

$request = new DirectionsRequest('New York', 'Washington');
```

The directions request constructor requires an origin as first argument and a destination as second argument.
 
## Configure origin

If you want to update the origin, you can use:

``` php
$request->setOrigin('New York');
```

The origin also accepts a coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setOrigin(new Coordinate(1.1, 2.1));
```

## Configure destination

If you want to update the destination, you can use:

``` php
$request->setDestination('Washington');
```

The destination also accepts a coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setDestination(new Coordinate(2.1, 1.1));
```

## Configure waypoints

If you want to add waypoint to your direction, you can use:

``` php
use Ivory\GoogleMap\Service\Directions\DirectionsWaypoint;

$request->addWaypoint(new DirectionsWaypoint('Philadelphia'));
```

The waypoint also accepts a coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Directions\DirectionsWaypoint;

$request->addWaypoint(new DirectionsWaypoint(new Coordinate(1.2, 2.2)));
```

## Configure waypoints optimization

If you want to optimize waypoints, you can use:

``` php
$request->setOptimizeWaypoints(true);
```

## Configure avoid highways

If you want to avoid highways, you can use:

``` php
$request->setAvoidHighways(true);
```

## Configure avoid tolls

If you want to avoid tolls, you can use:

``` php
$request->setAvoidTolls(true);
```

## Configure route alternatives

If you want to have route alternatives, you can use:

``` php
$request->setProvideRouteAlternatives(true);
```

## Configure travel mode

If you want to define your travel mode, you can use:

``` php
use Ivory\GoogleMap\Service\Base\TravelMode;

$request->setTravelMode(TravelMode::DRIVING);
```

## Configure unit system

If you want to update the unit system, you can use:

``` php
use Ivory\GoogleMap\Service\Base\UnitSystem;

$request->setUnitSystem(UnitSystem::METRIC);
```

## Configure region

If you want to update the region, you can use:

``` php
$request->setRegion('us');
```

## Configure language

If you want to update the language, you can use:

``` php
$request->setLanguage('fr');
```
