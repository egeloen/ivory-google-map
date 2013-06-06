# Directions Request

## Build a directions request

``` php
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

$request = new DirectionsRequest();

// Set your origin
$request->setOrigin('New York')
$request->setOrigin(1.1, 2.1, true);

// Set your destination
$request->setDestination('Washington');
$request->setDestination(2.1, 1.1, true);

// Set your waypoints
$request->addWaypoint('Philadelphia');
$request->addWaypoint(1.2, 2.2, true);

// If you use waypoint, optimize it
$request->setOptimizeWaypoints(true);

$request->setAvoidHighways(true);
$request->setAvoidTolls(true);
$request->setProvideRouteAlternatives(true);

$request->setRegion('us');
$request->setLanguage('en');
$request->setTravelMode(TravelMode::DRIVING);
$request->setUnitSystem(UnitSystem::METRIC);
$request->setSensor(false);
```

## Route your request

``` php
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;

$request = new DirectionsRequest();

// Route your request
$response = $directions->route($request);
```
