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
