# Geocoder Request

## Create your geocoder request

``` php
use Ivory\GoogleMap\Services\Geocoding\GeocoderRequest;

$request = new GeocoderRequest();
```

## Configure your geocoder request

### Configure your location

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setLocation('1600 Amphitheatre Parkway, Mountain View, CA');
// or
$request->setCoordinate(new Coordinate(1.1, 2.1));
```

### Configure the bound

``` php
$request->setBound(-1.1, -2.1, 2.1, 1.1, true, true);
```

### Configure the region

``` php
$request->setRegion('en');
```

### Configure the language

``` php
$request->setLanguage('en');
```

### Configure the sensor

``` php
$request->setSensor(false);
```
