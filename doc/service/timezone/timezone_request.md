# TimeZone Request

A timezone request is the starting point when you want to process a timezone.

## Build

First of all, if you want to process a timezone, you will need to build a timezone request. So let's go:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequest;

$request = new TimeZoneRequest(
    new Coordinate(39.6034810, -119.6822510),
    new \DateTime('@1331161200')
);
```

The timezone request constructor requires an location as first argument and a date as second argument.

## Configure location

If you want to update the location, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$request->setLocation(new Coordinate(39.6034810, -119.6822510)):
```

## Configure date

If you want to update the date, you can use:

``` php
$request->setDate(new \DateTime());
```

## Configure language

If you want to update the language, you can use:

``` php
$request->setLanguage('fr');
```
