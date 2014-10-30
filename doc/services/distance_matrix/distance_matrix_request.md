# Distance Matrix Request

## Build your distance matrix request

``` php
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;

$request = new DistanceMatrixRequest(
    array('New York'),
    array('Washington')
);
```

## Configure your distance matrix request

### Configure the origins

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setOrigins(array('New York'));
$request->setOrigins(array(new Coordinate(1.1, 2.1)));
```

### Configure the destinations

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setDestinations(array('Washington'));
$request->setDestinations(array(new Coordinate(2.1, 1.1)));
```

### Configure the avoid highways

``` php
$request->setAvoidHighways(true);
```

### Configure the avoid tolls

``` php
$request->setAvoidTolls(true);
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
