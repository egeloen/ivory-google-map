# TimeZone Response

When you have requested your timezone, the returned object is a `TimeZoneResponse`. It wraps a status and many other 
informations.

## Status

The available status are defined by the `TimeZoneStatus` constants.

``` php
$status = $response->getStatus();
```

## Dst offset

The offset for daylight-savings time in seconds. This will be zero if the time zone is not in Daylight Savings Time 
during the specified timestamp.

``` php
$dstOffset = $response->getDslOffset();
```

## Raw offset

The offset from UTC (in seconds) for the given location. This does not take into effect daylight savings.

``` php
$rawOffset = $response->getRawOffset();
```

## TimeZone id

A string containing the "tz" ID of the time zone, such as "America/Los_Angeles" or "Australia/Sydney".

``` php
$timeZoneId = $response->getTimeZoneId();
```

## TimeZone name

A string containing the long form name of the time zone. This field will be localized if the language parameter is set.

``` php
$timeZoneName = $response->getTimeZoneName();
```
