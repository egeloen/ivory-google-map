# Directions Request

## Build your directions request

``` php
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;

$request = new DirectionsRequest('New York', 'Philadelphia');
```

## Configure your directions request

### Configure the origin

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setOrigin('New York')
$request->setOrigin(new (1.1, 2.1));
```

The origin can be either a string or an `Ivory\GoogleMap\Base\Coordinate`.

### Configure the destination

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setDestination('Washington');
$request->setDestination(new Coordinate(2.1, 1.1));
```

The destination can be either a string or an `Ivory\GoogleMap\Base\Coordinate`.

### Configure the waypoints

``` php
$request->addWaypoint('Philadelphia');
$request->addWaypoint(1.2, 2.2, true);
```

The waypoints can be either a string or an `Ivory\GoogleMap\Base\Coordinate`.

### Configure the optimize waypoints

``` php
$request->setOptimizeWaypoints(true);
```

### Configure the avoid highways

``` php
$request->setAvoidHighways(true);
```

### Configure the avoid tolls

``` php
$request->setAvoidTolls(true);
```

### Configure the provide route alternatives

``` php
$request->setProvideRouteAlternatives(true);
```

### Configure the region

``` php
$request->setRegion('us');
```

### Configure the language

``` php
$request->setLanguage('en');
```

### Configure the travel mode

``` php
use Ivory\GoogleMap\Services\Base\TravelMode;

$request->setTravelMode(TravelMode::DRIVING);
```

### Configure the unit system

``` php
use Ivory\GoogleMap\Services\Base\UnitSystem;

$request->setUnitSystem(UnitSystem::METRIC);
```

### Configure the sensor

``` php
$request->setSensor(false);
```
