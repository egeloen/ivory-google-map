# Distance Matrix Request

A distance matrix request is the starting point when you want to process a distance matrix.

## Build

First of all, if you want to process a distance matrix, you will need to build a distance matrix request. So let's go:

``` php
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixRequest;

$request = new DistanceMatrixRequest(['New York'], ['Washington']);
```

The distance matrix constructor requires an array of origins as first argument and an array of destinations as second 
argument.

## Configure origins

If you want to update origins, you can use:
 
``` php
$request->setOrigins(['New York']);
```

The origins also accepts coordinates:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setOrigins([new Coordinate(1.1, 2.1)]);
```

## Configure destinations

If you want to update destinations, you can use:

``` php
$request->setDestinations(['Washington']);
```

The destinations also accepts coordinates:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setDestinations([new Coordinate(2.1, 1.1)]);
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

## Configure avoid

If you want to avoid tolls, highways, ferries or indoor, you can use:

``` php
use Ivory\GoogleMap\Service\Base\Avoid;

$request->setAvoid(Avoid::HIGHWAYS);
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

## Configure travel mode

If you want to choose a travel mode, you can use:

``` php
use Ivory\GoogleMap\Service\Base\TravelMode;

$request->setTravelMode(TravelMode::DRIVING);
```

## Configure unit system

if you want to update the unit system, you can use:

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
