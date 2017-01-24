# Direction Transit Details

Transit direction return additional information that is not relevant for other modes of transportation. These 
additional properties are exposed through the `DirectionTransitDetails` object, returned as a field of an element in 
the steps array. From it, you can access additional information about the transit stop, transit line and transit 
agency.

``` php
$transitDetails = $step->getTransitDetails();
```

## Departure stop

It contains information about the departure stop/station for this part of the trip.

``` php
$departureStop = $transitDetails->getDepartureStop();
```

## Arrival stop

It contains information about the arrival stop/station for this part of the trip.

``` php
$arrivalStop = $transitDetails->getArrivalStop();
```

## Departure time

It contain the departure times for this leg of the journey. It is represented by a `Time`.

``` php
$departureTime = $transitDetails->getDepartureTime();
```

If you want to learn more about the time, you can read its [documentation](/doc/service/base/time.md).

## Arrival time

It contain the arrival times for this leg of the journey. It is represented by a `Time`.

``` php
$arrrivalTime = $transitDetails->getArrivalTime();
```

If you want to learn more about the time, you can read its [documentation](/doc/service/base/time.md).

## Head sign

It specifies the direction in which to travel on this line, as it is marked on the vehicle or at the departure stop. 
This will often be the terminus station.

``` php
$headSign = $transitDetails->getHeadSign();
```

## Head way

It specifies the expected number of seconds between departures from the same stop at this time.

``` php
$headWay = $transitDetails->getHeadWay();
```

## Line

It contains information about the transit line used in this step.

``` php
$line = $transitDetails->getLine();
```

### Name

It contains the full name of this transit line.

``` php
$name = $line->getName();
```

### Short name

It contains the short name of this transit line.

``` php
$shortName = $line->getShortName();
```

### Color

It contains the color commonly used in signage for this transit line. The color will be specified as a hex string.

``` php
$color = $line->getColor();
```

### Url

It contains the URL for this transit line as provided by the transit agency.

``` php
$url = $line->getUrl();
```

### Icon

It contains the URL for the icon associated with this line.

``` php
$icon = $line->getIcon();
```

### Text color

It contains the color of text commonly used for signage of this line. The color will be specified as a hex string.

``` php
$textColor = $line->getTextColor();
```

### Agencies

It contains an array of `DirectionTransitAgency` objects that each provide information about the operator of the line.

``` php
$agencies = $line->getAgencies();
```

### Vehicle

It contains the type of vehicle used on this line.

``` php
$vehicle = $line->getVehicle();
```

## Agency

A transit agency contains a name, a phone & an url.

``` php
foreach ($line->getAgencies() as $agency) {
    // ...
}
```

### Name

It contains the name of the transit agency.

``` php
$name = $agency->getName();
```

### Phone

It contains the phone number of the transit agency.

``` php
$phone = $agency->getPhone();
```

### Url

It contains the URL for the transit agency.

``` php
$url = $agency->getUrl();
```

## Vehicle

A transit vehicle contains a name, an icon & a type. The vehicle types are represented by the 
`DirectionTransitVehicleType` constants.

``` php
$vehicle = $line->getVehicle();
```

### Name

It contains the name of the vehicle on this line.

``` php
$name = $vehicle->getName();
```

### Icon

It contains the URL for an icon associated with this vehicle type.

``` php
$icon = $vehicle->getIcon();
```

### Type

It contains the type of vehicle that runs on this line.

``` php
$type = $vehicle->getType();
```

### Local icon

It  contains the URL for the icon associated with this vehicle type, based on the local transport signage.

``` php
$localIcon = $vehicle->getLocalIcon();
```
