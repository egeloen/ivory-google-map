## Base Service Objects

The base service objects are shared classes which are reused across multiple services such as Direction, Distance 
Matrix, ...

## Distance

A distance represents a distance between two points. It contains a text and a value.

### Text

It contains a human-readable representation of the distance, displayed in units as used at the origin (or as overridden 
within the units parameter in the request).

``` php
$text = $distance->getText();
```

### Value

It indicates the distance in meters.

``` php
$value = $distance->getValue();
```

## Duration

A duration represents a time period. It contains a text and a value. 

### Text

It contains a human-readable representation of the duration.

``` php
$text = $duration->getText();
```

### Value

It indicates the duration in seconds.

``` php
$value = $duration->getValue();
```

## Fare

A fare represents a required tax. It contains a text, a value and a currency. 

### Text

The total fare amount, formatted in the requested language.

``` php
$text = $fare->getText();
```

### Value

The total fare amount, in the currency specified above.

``` php
$value = $fare->getValue();
```

### Currency

An [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code indicating the currency that the amount is 
expressed in.

``` php
$currency = $fare->getCurrency();
```

## Time

A time represents a specific moment. It contains a text, a value and a timezone. 

### Value

The time value if a `DateTime` object configured with the above timezone:

``` php
$value = $time->getValue();
```

### Time zone

The timezone of the time: 

``` php
$timeZone = $time->getTimeZone();
```

### Text

The time, formatted in the requested language:

``` php
$text = $time->getText();
```

## Location

A location is a place you would like to request in the [Direction](/doc/service/directons/direction.md) or 
[Distance Matrix](/doc/service/distance_matrix/distance_matrix.md) services. When configuring an origin or a 
destination, you can use one of the following implementations.

### Address location

An address location represents an address:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;

$location = new AddressLocation('Lille');
```

If you want to update the location address, you can use:

``` php
$location->setAddress('Paris');
```

### Coordinate location

A coordinate location represents a coordinate:

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;

$location = new CoordinateLocation(new Coordinate(48.865475, 2.321118));
```

If you want to update the location coordinate, you can use:

``` php
use Ivory\GoogleMap\Base\Coordinate;

$location->setCoordinate(new Coordinate(48.865475, 2.321118));
```

### Place id location

An place id location represents a place id:

``` php
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;

$location = new PlaceIdLocation('ChIJ3S-JXmauEmsRUcIaWtf4MzE');
```

If you want to update the location place id, you can use:

``` php
$location->setPlaceId('ChIJ3S-JXmauEmsRUcIaWtf4MzE');
```

### Encoded polyline location

An encoded polyline location represents an encoded polyline:

``` php
use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;

$location = new EncodedPolylineLocation('wc~oAwquwMdlTxiKtq');
```

If you want to update the location encoded polyline, you can use:

``` php
$location->setEncodedPolyline('wc~oAwquwMdlTxiKtq');
```
