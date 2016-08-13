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

## Configure departure time

If you want to provide a departure time, you can use:

``` php
$request->setDepartureTime(new \DateTime());
```

## Configure arrival time

If you want to provide an arrival time, you can use:

``` php
$request->setDepartureTime(new \DateTime());
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

## Configure avoid

If you want to avoid tolls, highways ferries or indoor, you can use:

``` php
use Ivory\GoogleMap\Service\Base\Avoid;

$request->setAvoid(Avoid::HIGHWAYS);
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

## Configure traffic model

If you want to define your traffic model, you can use:

``` php
use Ivory\GoogleMap\Service\Base\TrafficModel;

$request->setTrafficModel(TrafficModel::BEST_GUESS);
```

## Configure transit modes

If you want to define your transit modes, you can use:

``` php
use Ivory\GoogleMap\Service\Base\TransitMode;

$request->setTransitModes([
    TransitMode::BUS,
    TransitMode::TRAIN,
]);
```

## Configure transit routing preference

If you want to define your transit routing preference, you can use:

``` php
use Ivory\GoogleMap\Service\Base\TransitRoutingPreference;

$request->setTransitRoutingPreference(TransitRoutingPreference::LESS_WALKING);
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
