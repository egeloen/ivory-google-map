# Location

A location is a place you would like to request in the [Direction](/doc/service/directons/direction.md) or 
[Distance Matrix](/doc/service/distance_matrix/distance_matrix.md) services. When configuring an origin or a 
destination, you can use one of the following implementations.

## Address location

An address location represents an address:

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;

$location = new AddressLocation('Lille');
```

If you want to update the location address, you can use:

``` php
$location->setAddress('Paris');
```

## Coordinate location

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

## Place id location

An place id location represents a place id:

``` php
use Ivory\GoogleMap\Service\Base\Location\PlaceIdLocation;

$location = new PlaceIdLocation('ChIJ3S-JXmauEmsRUcIaWtf4MzE');
```

If you want to update the location place id, you can use:

``` php
$location->setPlaceId('ChIJ3S-JXmauEmsRUcIaWtf4MzE');
```

## Encoded polyline location

An encoded polyline location represents an encoded polyline:

``` php
use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;

$location = new EncodedPolylineLocation('wc~oAwquwMdlTxiKtq');
```

If you want to update the location encoded polyline, you can use:

``` php
$location->setEncodedPolyline('wc~oAwquwMdlTxiKtq');
```
