# Direction Request

A direction request is the starting point when you want to request a direction.

## Build

First of all, if you want to route a direction, you will need to build a direction request. So let's go:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Direction\DirectionRequest\Request;

$request = new DirectionRequest(
    new AddressLocation('New York'), 
    new AddressLocation('Washington')
);
```

The direction request constructor requires an origin as first argument and a destination as second argument.
 
## Configure origin

If you want to update the origin, you can use:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;

$request->setOrigin(new AddressLocation('New York'));
```

The origin is represented by the `LocationInterface`. If you want to learn more about it, you can read its 
[documentation](/doc/service/base.html#location).

## Configure destination

If you want to update the destination, you can use:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;

$request->setDestination(new AddressLocation('Washington'));
```

The destination is represented by the `LocationInterface`. If you want to learn more about it, you can read its 
[documentation](/doc/service/base.html#location).

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
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Direction\Request\DirectionWaypoint;

$request->addWaypoint(new DirectionWaypoint(new AddressLocation('Philadelphia')));
```

The waypoint accepts a `LocationInterface` as first argument. If you want to learn more about it, you can read its 
[documentation](/doc/service/base.html#location).

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
